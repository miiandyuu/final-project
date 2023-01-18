@extends('layouts.dashboard.master')

@section('page-title', 'Perbandingan Kriteria')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4 class="text-center mb-3">Perbandingan Kriteria</h4>
@endsection

@section('content')
@php

foreach ($allKriteria as $kriteria) {
    $choices[] = $kriteria->kode_database;
}

$matrik = array();
$urut 	= 0;
for ($x=0; $x <= ($criteriaCount-2) ; $x++) {
	for ($y=($x+1); $y <= ($criteriaCount-1) ; $y++) {
		$urut++;
		$pilih	= "pilih".$urut;
		$bobot 	= "bobot".$urut;

		if ($_POST[$pilih] == 1) {
			$matrik[$x][$y] = $_POST[$bobot];
			$matrik[$y][$x] = 1 / $_POST[$bobot];
		} else {
			$matrik[$x][$y] = 1 / $_POST[$bobot];
			$matrik[$y][$x] = $_POST[$bobot];
		}
		inputDataPerbandinganKriteria($x,$y,$matrik[$x][$y]);
	}
}

    // diagonal --> bernilai 1
    for ($i = 0; $i <= ($criteriaCount-1); $i++) {
		$matrik[$i][$i] = 1;
	}

	// inisialisasi jumlah tiap kolom dan baris kriteria
	$jmlmpb = array();
	$jmlmnk = array();
	for ($i=0; $i <= ($criteriaCount-1); $i++) {
		$jmlmpb[$i] = 0;
		$jmlmnk[$i] = 0;
	}

	for ($x=0; $x <= ($criteriaCount-1) ; $x++) {
		for ($y=0; $y <= ($criteriaCount-1) ; $y++) {
			$value		= $matrik[$x][$y];
			$jmlmpb[$y] += $value;

		}
	}

	for ($x=0; $x <= ($criteriaCount-1) ; $x++) {
		for ($y=0; $y <= ($criteriaCount-1) ; $y++) {
			$matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
			$value	= $matrikb[$x][$y];
			$jmlmnk[$x] += $value;

		}
		$pv[$x]	 = $jmlmnk[$x] / $criteriaCount;
		$kriteria_id = getKriteriaID($x);
		inputKriteriaPV($kriteria_id,$pv[$x]);
	}
	$eigenvektor = getEigenVector($jmlmpb,$jmlmnk,$criteriaCount);
	$consIndex   = getConsIndex($jmlmpb,$jmlmnk,$criteriaCount);
	$consRatio   = getConsRatio($jmlmpb,$jmlmnk,$criteriaCount);
@endphp

<section class="content" style="overflow-x: scroll; ">
	<h3 class="ui header">Matriks Perbandingan Berpasangan</h3>
	<table class="table table-bordered table-sm">
		<thead>
			<tr>
				<th>Kriteria</th>
				<?php
					for ($i=0; $i <= ($criteriaCount-1); $i++) {
						echo "<th>".getKriteriaNama($i)."</th>";
					}
				?>
			</tr>
		</thead>
		<tbody>
<?php
	for ($x=0; $x <= ($criteriaCount-1); $x++) {
		echo "<tr>";
		echo "<td>".getKriteriaNama($x)."</td>";
			for ($y=0; $y <= ($criteriaCount-1); $y++) {
				echo "<td>".round($matrik[$x][$y],5)."</td>";
			}

		echo "</tr>";
	}
?>
		</tbody>
		<tfoot>			<tr>
				<th>Jumlah</th>
<?php
		for ($i=0; $i <= ($criteriaCount-1); $i++) {
			echo "<th>".round($jmlmpb[$i],5)."</th>";
		}
?>
			</tr>
		</tfoot>
	</table>


	<br>

	<h3 class="ui header">Matriks Nilai Kriteria</h3>
	<table class="table table-bordered table-sm">
		<thead>
			<tr>
				<th>Kriteria</th>
<?php
	for ($i=0; $i <= ($criteriaCount-1); $i++) {
		echo "<th>".getKriteriaNama($i)."</th>";
	}
?>
				<th>Jumlah</th>
				<th>Priority Vector</th>
			</tr>
		</thead>
		<tbody>
<?php
	for ($x=0; $x <= ($criteriaCount-1); $x++) {
		echo "<tr>";
		echo "<td>".getKriteriaNama($x)."</td>";
			for ($y=0; $y <= ($criteriaCount-1); $y++) {
				echo "<td>".round($matrikb[$x][$y],5)."</td>";
			}

		echo "<td>".round($jmlmnk[$x],5)."</td>";
		echo "<td>".round($pv[$x],5)."</td>";

		echo "</tr>";
	}
?>

		</tbody>
		<tfoot>
			<tr>
				<th colspan="<?php echo ($criteriaCount+2)?>">Principe Eigen Vector (λ maks)</th>
				<th><?php echo (round($eigenvektor,5))?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($criteriaCount+2)?>">Consistency Index</th>
				<th><?php echo (round($consIndex,5))?></th>
			</tr>
			<tr>
				<th colspan="<?php echo ($criteriaCount+2)?>">Consistency Ratio</th>
				<th><?php echo (round(($consRatio * 100),2))?> %</th>
			</tr>
		</tfoot>
	</table>

<?php
	if ($consRatio > 0.1) {
?>
		<div class="alert alert-danger alert-dismissible " role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
		</button>
		<strong>Nilai Consistency Ratio melebihi 10% !!!</strong>
		<p>Mohon input kembali tabel perbandingan...</p>
		</div>

		<a href='javascript:history.back()'>
		<button class="btn btn-default">
			<i class="fa fa-arrow-left"></i>
				Kembali
			</button>
		</a>

<?php
	} else {

?>
<br>
@php
    $data = DB::table('kriteria')->orderBy('id','ASC')->first();
	$kriteria_id = $data->id;
@endphp
<form action="{{ route('prosess_sub_spk') }}" method="POST">
    @csrf
    <input type="hidden" name="kriteria_id" value="{{ $kriteria_id }}">
    <button class="btn btn-success">
        <i class="fa fa-arrow-right"></i>
            Lanjut
    </button>
</form>
</section>
<?php
	}
?>

@endsection
