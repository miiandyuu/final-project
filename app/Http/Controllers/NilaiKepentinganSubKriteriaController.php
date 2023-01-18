<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiKepentinganSubKriteriaController extends Controller
{
    public function prosess_sub_spk(){
        $kriteria_id = $_POST['kriteria_id'];
        $subCriteriaCount = DB::table('subkriteria')->count();

        return view('dashboard.perbandingan_sub_kriteria.index', compact('subCriteriaCount'))->with([
            'kriteria_id' => $kriteria_id
        ]);
    }

    public function hasil_sub_spk(){
        $kriteria_id = DB::table('subkriteria')->get('kriteria_id')->count();
        $subCriteriaCount = DB::table('subkriteria')->count();

        return view('dashboard.perbandingan_sub_kriteria.hasil', compact('kriteria_id', 'subCriteriaCount'));
    }
}
