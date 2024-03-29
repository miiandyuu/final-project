@extends('layouts.dashboard.master')

@section('page-title', 'Perbandingan Sub Kriteria')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4 class="text-center mb-3">Perbandingan Sub Kriteria</h4>
@endsection

@section('content')
@php
$kriteria_id =$_POST['kriteria_id'];
// dd($kriteria_id);

$n = DB::table("subkriteria")
       ->where('kriteria_id', '=', $kriteria_id)
       ->count();
$matrik = array();
$urut 	= 0;
for ($x=0; $x <= ($n-2) ; $x++) {
	for ($y=($x+1); $y <= ($n-1) ; $y++) {
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
		inputDataPerbandinganSubKriteria($x,$y,$matrik[$x][$y],$kriteria_id);
	}
}
// diagonal --> bernilai 1
for ($i = 0; $i <= ($n-1); $i++) {
		$matrik[$i][$i] = 1;
	}
    // inisialisasi jumlah tiap kolom dan baris kriteria
	$jmlmpb = array();
	$jmlmnk = array();
	for ($i=0; $i <= ($n-1); $i++) {
		$jmlmpb[$i] = 0;
		$jmlmnk[$i] = 0;
	}
	// menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
	for ($x=0; $x <= ($n-1) ; $x++) {
		for ($y=0; $y <= ($n-1) ; $y++) {
			$value		= $matrik[$x][$y];
			$jmlmpb[$y] += $value;
		}
	}
	for ($x=0; $x <= ($n-1) ; $x++) {
		for ($y=0; $y <= ($n-1) ; $y++) {
			$matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
			$value	= $matrikb[$x][$y];
			$jmlmnk[$x] += $value;
		}
		$pv[$x]	 = $jmlmnk[$x] / $n;
		$sub_kriteria_id = getSubKriteriaID($x,$kriteria_id);
		inputSubKriteriaPV($sub_kriteria_id,$pv[$x]);
	}
    $eigenvektor = getEigenVector($jmlmpb,$jmlmnk,$n);
	$consIndex   = getConsIndex($jmlmpb,$jmlmnk,$n);
	$consRatio   = getConsRatio($jmlmpb,$jmlmnk,$n);


@endphp

<section class="header-menu mb-3">
	<div class="card m-0 border shadow-none p-3">
		<h4 class="text-center mb-3">Matriks Perbandingan Berpasangan</h4>
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th class="text-center">Kriteria</th>
						<?php
							for ($i=0; $i <= ($n-1); $i++) {
								echo "<th class='text-center'>".getSubKriteriaNama($i,$kriteria_id)."</th>";
							}
						?>
					</tr>
				</thead>
				<tbody class="bg-white">
					<?php
						for ($x=0; $x <= ($n-1); $x++) {
							echo "<tr>";
							echo "<td class='text-center'>".getSubKriteriaNama($x,$kriteria_id)."</td>";
								for ($y=0; $y <= ($n-1); $y++) {
									echo "<td class='text-center'>".round($matrik[$x][$y],5)."</td>";
								}
							echo "</tr>";
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th  class='text-center'>Jumlah</th>
						<?php
							for ($i=0; $i <= ($n-1); $i++) {
								echo "<th class='text-center'>".round($jmlmpb[$i],5)."</th>";
							}
						?>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</section>

<section class="header-menu mb-3">
	<div class="card m-0 border shadow-none p-3">
		<h4 class="text-center mb-3">Matriks Nilai Sub Kriteria</h4>
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th class="text-center">Kriteria</th>
						<?php
							for ($i=0; $i <= ($n-1); $i++) {
								echo "<th class='text-center'>".getSubKriteriaNama($i,$kriteria_id)."</th>";
							}
						?>
						<th class="text-center">Jumlah</th>
						<th class="text-center">Priority Vector</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					<?php
						for ($x=0; $x <= ($n-1); $x++) {
							echo "<tr>";
								echo "<td class='text-center'>".getSubKriteriaNama($x,$kriteria_id)."</td>";
									for ($y=0; $y <= ($n-1); $y++) {
										echo "<td class='text-center'>".round($matrikb[$x][$y],5)."</td>";
									}
								echo "<td class='text-center'>".round($jmlmnk[$x],5)."</td>";
								echo "<td class='text-center'>".round($pv[$x],5)."</td>";
							echo "</tr>";
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="<?php echo ($n+2)?>">Principe Eigen Vector (λ maks)</th>
						<th class='text-center'><?php echo (round($eigenvektor,5))?></th>
					</tr>
					<tr>
						<th colspan="<?php echo ($n+2)?>">Consistency Index</th>
						<th class='text-center'><?php echo (round($consIndex,5))?></th>
					</tr>
					<tr>
						<th colspan="<?php echo ($n+2)?>">Consistency Ratio</th>
						<th class='text-center'><?php echo (round(($consRatio * 100),2))?> %</th>
					</tr>
				</tfoot>
			</table>
		</div>
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
		@php
			$jml = DB::table('kriteria')->count();
		@endphp
		@if ($jml == $kriteria_id)
			<form action="{{ route('nilai_alternatif') }}" method="POST">
				@csrf
				<input type="hidden" name="kriteria_id" value="{{ $kriteria_id }}">
				<button class="btn btn-success">
					<i class="fa fa-arrow-right"></i>
					Lanjut
				</button>
			</form>
		@else
			@php
				//cek next kriteria id
				$data = DB::table('kriteria')->orderBy('id', 'ASC')
				->where('id', '>', $kriteria_id)
				->first();
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
		@endif
	</div>
</section>
  <?php
	}
	?>

@endsection
