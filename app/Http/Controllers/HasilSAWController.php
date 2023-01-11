<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilSAWController extends Controller
{
    public function index()
    {
        $checkHasEmptyData = $this->check_nilai_bobot_has_empty_data();
        $nilaiBobotGroupByAlternatifId = [];
        $persentaseBobot = [];
        $matrixTernormalisasi = [];
        if (!$checkHasEmptyData) {
            $nilaiBobotGroupByAlternatifId = DB::table('nilai_bobot')
                ->join('alternatif', 'nilai_bobot.alternatif_id', '=', 'alternatif.id')
                ->select('nilai_bobot.alternatif_id', 'alternatif.code', 'alternatif.code_saham')
                ->orderBy('nilai_bobot.alternatif_id')
                ->groupBy('nilai_bobot.alternatif_id')
                ->get();
            $persentaseBobot = $this->persentase_bobot();
            $matrixTernormalisasi = $this->matrix_ternormalisasi($nilaiBobotGroupByAlternatifId);
        }
        // dd($matrixTernormalisasi);

        return view('dashboard.hasil_saw.index', compact(['nilaiBobotGroupByAlternatifId', 'persentaseBobot', 'matrixTernormalisasi', 'checkHasEmptyData']));
    }

    public function hasil()
    {
        $checkHasEmptyData = $this->check_nilai_bobot_has_empty_data();
        $hasilPerankingan = [];
        if (!$checkHasEmptyData) {
            $hasilPerankingan = $this->sorting_vektor_v();
        }

        return view('dashboard.hasil_saw.hasil', compact(['hasilPerankingan', 'checkHasEmptyData']));
    }

    protected function persentase_bobot()
    {
        $allBobot = DB::table('kriteria')->get();
        $totalBobot = $allBobot->sum('bobot');
        $result = [];

        foreach ($allBobot as $item) {
            // Kali 10 agar total menjadi bobot = 10
            $resultBobot = $item->bobot / $totalBobot * 10;
            $result[] = ['id' => $item->id, 'name' => $item->name, 'description' => $item->description, 'type' => $item->type, 'bobot' => $item->bobot, 'persentase_bobot' => $resultBobot];
        }

        return $result;
    }

    protected function matrix_ternormalisasi($arrayNilaiBobotByAlternatifId = [])
    {
        $result = [];

        foreach ($arrayNilaiBobotByAlternatifId as $item) {
            $selectedNilaiBobot = DB::table('nilai_bobot')
                ->where('alternatif_id', '=', $item->alternatif_id)
                ->orderBy('kriteria_id')
                ->get();

            $result[] = $this->min_max($selectedNilaiBobot);
        }

        return $result;
    }

    protected function min_max($arraySelectedNilaiBobot = [])
    {
        $nilaiBobotGroupByKriteriaId = DB::table('nilai_bobot')
            ->join('kriteria', 'nilai_bobot.kriteria_id', '=', 'kriteria.id')
            ->select('kriteria_id', 'kriteria.name', 'kriteria.type', DB::raw('MAX(nilai) AS max_nilai_kriteria'), DB::raw('MIN(nilai) AS min_nilai_kriteria'))
            ->orderBy('kriteria_id')
            ->groupBy('kriteria_id')
            ->get();

        $result = [];

        for ($i = 0; $i < count($nilaiBobotGroupByKriteriaId); $i++) {
            // nilai / MAX VALUE
            if ($nilaiBobotGroupByKriteriaId[$i]->type == 'benefit') {
                $valueR = $arraySelectedNilaiBobot[$i]->nilai / $nilaiBobotGroupByKriteriaId[$i]->max_nilai_kriteria;
                $result[] = ['krit_name' => $nilaiBobotGroupByKriteriaId[$i]->name, 'value_r' => $valueR];
            }

            // MIN VALUE / nilai
            if ($nilaiBobotGroupByKriteriaId[$i]->type == 'cost') {
                $valueR = $nilaiBobotGroupByKriteriaId[$i]->min_nilai_kriteria / $arraySelectedNilaiBobot[$i]->nilai;
                $result[] = ['krit_name' => $nilaiBobotGroupByKriteriaId[$i]->name, 'value_r' => $valueR];
            }
        }

        return $result;
    }

    protected function calculate_ranking()
    {
        $nilaiBobotGroupByAlternatifId = DB::table('nilai_bobot')
            ->join('alternatif', 'nilai_bobot.alternatif_id', '=', 'alternatif.id')
            ->select('nilai_bobot.alternatif_id', 'alternatif.code', 'alternatif.code_saham', 'alternatif.name_saham')
            ->orderBy('nilai_bobot.alternatif_id')
            ->groupBy('nilai_bobot.alternatif_id')
            ->get();
        $persentaseBobot = $this->persentase_bobot();
        $matrixTernormalisasi = $this->matrix_ternormalisasi($nilaiBobotGroupByAlternatifId);
        $result = [];

        for ($i = 0; $i < count($nilaiBobotGroupByAlternatifId); $i++) {
            // 0 Karena Penjumlahan
            $vektorV = 0;

            for ($j = 0; $j < count($persentaseBobot); $j++) {
                $vektorV += $persentaseBobot[$j]['persentase_bobot'] * $matrixTernormalisasi[$i][$j]['value_r'];
            }

            $result[] = ['alternatif_code' => $nilaiBobotGroupByAlternatifId[$i]->code, 'code_saham' => $nilaiBobotGroupByAlternatifId[$i]->code_saham, 'name_saham' => $nilaiBobotGroupByAlternatifId[$i]->name_saham, 'vektor_v' => $vektorV];
        }

        return $result;
    }

    protected function sorting_vektor_v()
    {
        $result = $this->calculate_ranking();
        $selectedSorting = array_column($result, 'vektor_v');
        array_multisort($selectedSorting, SORT_DESC, $result);

        return $result;
    }

    // Get From NilaiBobotController with some Edit
    protected function check_nilai_bobot_has_empty_data()
    {
        $condition = false;
        $EMPTY_VALUE = 'Empty';
        $allKriteria = Kriteria::all();
        $nilaiBobotGroupByAlternatifId = DB::table('nilai_bobot')
            ->join('alternatif', 'nilai_bobot.alternatif_id', '=', 'alternatif.id')
            ->select('alternatif_id', 'code', 'code_saham', 'name_saham')
            ->orderBy('alternatif.code')
            ->groupBy('alternatif.id')
            ->get();
        
        // Array For Compare to Data Nilai Bobot
        $arrayKriteriaIdFromKriteria = [];
        foreach($allKriteria as $item) {
            $arrayKriteriaIdFromKriteria[] = $item->id;
        }

        foreach ($nilaiBobotGroupByAlternatifId as $item) {
            $dataKriteria = [];

            $selectedNilaiBobot = DB::table('nilai_bobot')
                ->where('alternatif_id', '=', $item->alternatif_id)
                ->orderBy('kriteria_id')
                ->get();

            // Array for Compare to Data Kriteria ID
            $arrayKriteriaIdFromSelectedNilaiBobot = [];
            foreach ($selectedNilaiBobot as $itemKriteria) {
                $arrayKriteriaIdFromSelectedNilaiBobot[] = $itemKriteria->kriteria_id;
                $dataKriteria[] = ['kriteria_id' => $itemKriteria->kriteria_id, 'nilai' => $itemKriteria->nilai];
            }

            // Comparing Data Kriteria ID & Nilai Bobot
            $emptyKriteriaId = array_diff($arrayKriteriaIdFromKriteria, $arrayKriteriaIdFromSelectedNilaiBobot);
            foreach($emptyKriteriaId as $kriteriaId) {
                $dataKriteria[] = ['kriteria_id' => $kriteriaId, 'nilai' => $EMPTY_VALUE];
                $condition = true;
                break;
            }
        }

        return $condition;
    }
}
