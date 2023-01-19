<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NilaiAlternatifController extends Controller
{
    public function index(){
        $kriteria_id = $_POST['kriteria_id'];
        // $jenis_bansos_id = $_POST['jenis_bansos_id'];
        return view('dashboard.nilai_alternatif.index')->with([
            'kriteria_id' => $kriteria_id,
            // 'jenis_bansos_id' => $jenis_bansos_id
        ]);
    }
}
