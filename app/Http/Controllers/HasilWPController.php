<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilWPController extends Controller
{
    public function index()
    {
        $checkHasEmptyData = $this->check_nilai_bobot_has_empty_data();
        $bobotTernormalisasi = [];
        $vektorS = [];
        $vektorV = [];
        if (!$checkHasEmptyData) {
            $bobotTernormalisasi = $this->bobot_ternormalisasi();
            $vektorS = $this->vektor_s();
            $vektorV = $this->vektor_v();
        }

        return view('dashboard.hasil_wp.index', compact(['bobotTernormalisasi', 'vektorS', 'vektorV', 'checkHasEmptyData']));
    }

    public function hasil()
    {
        $checkHasEmptyData = $this->check_nilai_bobot_has_empty_data();
        $hasilPerankingan = [];
        if (!$checkHasEmptyData) {
            $hasilPerankingan = $this->sorting_vektor_v();
        }

        return view('dashboard.hasil_wp.hasil', compact(['hasilPerankingan', 'checkHasEmptyData']));
    }

    protected function bobot_ternormalisasi()
    {
        $allBobot = DB::table('kriteria')->get();
        $totalBobot = $allBobot->sum('bobot');
        $result = [];

        foreach ($allBobot as $item) {
            if ($item->type == 'cost') {
                $resultBobot = ($item->bobot / $totalBobot) * -1;
                $result[] = ['name' => $item->name, 'description' => $item->description, 'type' => $item->type, 'bobot' => $item->bobot, 'bobot_ternormalisasi' => $resultBobot];
            }

            if ($item->type == 'benefit') {
                $resultBobot = $item->bobot / $totalBobot;
                $result[] = ['name' => $item->name, 'description' => $item->description, 'type' => $item->type, 'bobot' => $item->bobot, 'bobot_ternormalisasi' => $resultBobot];
            }
        }

        return $result;
    }

    protected function vektor_s()
    {
        $nilaiBobotGroupByAlternatifId = DB::table('nilai_bobot')
            ->join('alternatif', 'nilai_bobot.alternatif_id', '=', 'alternatif.id')
            ->select('nilai_bobot.alternatif_id', 'alternatif.code', 'alternatif.code_saham', 'alternatif.name_saham')
            ->orderBy('nilai_bobot.alternatif_id')
            ->groupBy('nilai_bobot.alternatif_id')
            ->get();
        $bobotTernormalisasi = $this->bobot_ternormalisasi();
        $result = [];

        foreach ($nilaiBobotGroupByAlternatifId as $item) {
            // 1 Karena Perkalian
            $vektorS = 1;
            $selectedNilaiBobot = DB::table('nilai_bobot')->where('alternatif_id', '=', $item->alternatif_id)->orderBy('kriteria_id')->get();

            for ($i = 0; $i < count($bobotTernormalisasi); $i++) {
                $vektorS *= pow($selectedNilaiBobot[$i]->nilai, $bobotTernormalisasi[$i]['bobot_ternormalisasi']);
            }

            $result[] = ['alternatif_code' => $item->code, 'code_saham' => $item->code_saham, 'name_saham' => $item->name_saham, 'vektor_s' => $vektorS];
        }

        return $result;
    }

    protected function vektor_v()
    {
        $vektorS = $this->vektor_s();
        $totalVektorS = array_sum(array_column($vektorS, 'vektor_s'));
        $result = [];

        foreach ($vektorS as $item) {
            $vektorV = $item['vektor_s'] / $totalVektorS;
            $result[] = ['alternatif_code' => $item['alternatif_code'], 'code_saham' => $item['code_saham'], 'name_saham' => $item['name_saham'], 'vektor_v' => $vektorV];
        }

        return $result;
    }

    protected function sorting_vektor_v()
    {
        $vektorV = $this->vektor_v();
        $selectedSorting = array_column($vektorV, 'vektor_v');
        array_multisort($selectedSorting, SORT_DESC, $vektorV);

        return $vektorV;
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
