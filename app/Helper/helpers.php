<?php

use App\Models\Kriteria;
use Illuminate\Support\Facades\DB;

function getNilaiPerbandinganKriteria($urutan1, $urutan2)
{
	$kriteria_id1 = getKriteriaID($urutan1);
	$kriteria_id2 = getKriteriaID($urutan2);

    $list = DB::select("SELECT nilai FROM perbandingan_kriteria WHERE kriteria1 = $kriteria_id1 AND kriteria2 = $kriteria_id2");


    $jml = DB::table('perbandingan_kriteria')
    ->where('kriteria1', '=', $kriteria_id1)
    ->where('kriteria2', '=', $kriteria_id2)
    ->count();

	if ($jml == 0) {
		$nilai = 1;
	} else {
		foreach ($list as $row) {
			$nilai= $row->nilai;
		}
	}
    
	return $nilai;
}


function getKriteriaID($no_urut) {
    $list = DB::select("SELECT id FROM kriteria ORDER BY id ");
    if ($list) {
        foreach ($list as $a) {
                $listID[] = $a->id;
            }
     }
     return $listID[($no_urut)];
}

function inputDataPerbandinganKriteria($kriteria1,$kriteria2,$nilai) {
	$kriteria_id1 = getKriteriaID($kriteria1);
	$kriteria_id2 = getKriteriaID($kriteria2);
    $jml = DB::table('perbandingan_kriteria')
    ->where('kriteria1', '=', $kriteria_id1)
    ->where('kriteria2', '=', $kriteria_id2)
    ->count();
    
	if ($jml == 0) {
        DB::table('perbandingan_kriteria')->insert([
            'kriteria1' => $kriteria_id1,
            'kriteria2' => $kriteria_id2,
            'nilai' => $nilai,

        ]);
    }else{
        DB::table('perbandingan_kriteria')
              ->where('kriteria1', $kriteria_id1)
              ->where('kriteria2', $kriteria_id2)
              ->update(['nilai' => $nilai]);
	}
}

function getSubKriteriaID($no_urut, $kriteria_id) {
    $list = DB::select("SELECT id FROM subkriteria where kriteria_id='$kriteria_id' ORDER BY id ");
    if ($list) {
        foreach ($list as $a) {
                $listID[] = $a->id;
            }
     }
     return $listID[($no_urut)];
}

function getNilaiPerbandinganSubKriteria($urutan1,$urutan2,$kriteria_id)
{
	$sub_kriteria_id1 = getSubKriteriaID($urutan1,$kriteria_id);
	$sub_kriteria_id2 = getSubKriteriaID($urutan2,$kriteria_id);
    $list = DB::select("SELECT nilai FROM perbandingan_sub_kriteria WHERE sub_kriteria1= $sub_kriteria_id1 AND sub_kriteria2= $sub_kriteria_id2");
    $jml = DB::table("perbandingan_sub_kriteria")
       ->where('sub_kriteria1', '=', $sub_kriteria_id1)
       ->where('sub_kriteria2', '=', $sub_kriteria_id2)
       ->count();

	if ($jml == 0) {
		$nilai = 1;
	} else {
		foreach ($list as $row) {
			$nilai= $row->nilai;
		}
	}
	return $nilai;
}

function inputDataPerbandinganSubKriteria($sub_kriteria1,$sub_kriteria2,$nilai,$kriteria_id) {
	$sub_kriteria_id1 = getSubKriteriaID($sub_kriteria1,$kriteria_id);
	$sub_kriteria_id2 = getSubKriteriaID($sub_kriteria2,$kriteria_id);
    $jml = DB::table("perbandingan_sub_kriteria")
       ->where('sub_kriteria1', '=', $sub_kriteria_id1)
       ->where('sub_kriteria2', '=', $sub_kriteria_id2)
       ->count();
	if ($jml == 0) {
        DB::table('perbandingan_sub_kriteria')->insert([
            'sub_kriteria1' => $sub_kriteria_id1,
            'sub_kriteria2' => $sub_kriteria_id2,
            'nilai' => $nilai,
        ]);
    }else{
        DB::table('perbandingan_sub_kriteria')
              ->where('sub_kriteria1', $sub_kriteria_id1)
              ->where('sub_kriteria2', $sub_kriteria_id2)
              ->update(['nilai' => $nilai]);
	}
}

// memasukkan nilai priority vektor kriteria
function inputKriteriaPV ($kriteria_id,$pv) {
    $jml = DB::table("pv_kriteria")
       ->where('kriteria_id', '=', $kriteria_id)
       ->count();
	if ($jml==0) {
        DB::table('pv_kriteria')->insert([
            'kriteria_id' => $kriteria_id,
            'nilai' => $pv,

        ]);

	} else {
        DB::table('pv_kriteria')
              ->where('kriteria_id', $kriteria_id)
              ->update(['nilai' => $pv]);
	}
}

// memasukkan nilai priority vektor kriteria
function inputSubKriteriaPV ($sub_kriteria_id,$pv) {
    $jml = DB::table("pv_sub_kriteria")
       ->where('sub_kriteria_id', '=', $sub_kriteria_id)
       ->count();
	if ($jml==0) {
        DB::table('pv_sub_kriteria')->insert([
            'sub_kriteria_id' => $sub_kriteria_id,
            'nilai' => $pv,

        ]);

	} else {
        DB::table('pv_sub_kriteria')
              ->where('sub_kriteria_id', $sub_kriteria_id)
              ->update(['nilai' => $pv]);
	}
}

// mencari Principe Eigen Vector (λ maks)
function getEigenVector($matrik_a,$matrik_b,$n) {
	$eigenvektor = 0;
	for ($i=0; $i <= ($n-1) ; $i++) {
		$eigenvektor += ($matrik_a[$i] * (($matrik_b[$i]) / $n));
	}

	return $eigenvektor;
}

// mencari Cons Index
function getConsIndex($matrik_a,$matrik_b,$n) {
	$eigenvektor = getEigenVector($matrik_a,$matrik_b,$n);
	$consindex = ($eigenvektor - $n)/($n-1);
	return $consindex;
}

// Mencari Consistency Ratio
function getConsRatio($matrik_a,$matrik_b,$n) {
	$consindex = getConsIndex($matrik_a,$matrik_b,$n);
	$consratio = $consindex / getNilaiIR($n);
	return $consratio;
}

// menampilkan nilai IR
function getNilaiIR($jmlKriteria) {

    $query = DB::select("SELECT nilai FROM ir WHERE jumlah=$jmlKriteria");
    
	foreach ($query as $row) {
		$nilaiIR = $row->nilai;
	}
        
	return $nilaiIR;
}

// mencari nama kriteria
function getKriteriaNama($no_urut) {
    $query = DB::select("SELECT * FROM kriteria");

    foreach ($query as $row) {
		$nama[] = $row->name;
	}
	return $nama[($no_urut)];
}

function getSubKriteriaNama($no_urut,$kriteria_id) {

    $query = DB::select("SELECT nama_sub_kriteria FROM subkriteria where kriteria_id='$kriteria_id'");
    foreach ($query as $row) {
		$nama[] = $row->nama_sub_kriteria;
	}
	return $nama[($no_urut)];
}

function nama_kriteria_by_id($kriteria_id) {
    $kriteria = DB::table('kriteria')->where('id', $kriteria_id)->first();
    return $kriteria->name;
}




