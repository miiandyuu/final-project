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

<section class="header-menu mb-3">
	<div class="card m-0 border shadow-none p-3">
		<h4 class="text-center mb-3">Matriks Perbandingan Berpasangan</h4>
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th class="text-center">Kriteria</th>
						<?php
							for ($i=0; $i <= ($criteriaCount-1); $i++) {
								echo "<th class='text-center'>".getKriteriaNama($i)."</th>";
							}
						?>
					</tr>
				</thead>
				<tbody class="bg-white">
					<?php
						for ($x=0; $x <= ($criteriaCount-1); $x++) {
							echo "<tr>";
							echo "<td class='text-center'>".getKriteriaNama($x)."</td>";
								for ($y=0; $y <= ($criteriaCount-1); $y++) {
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
							for ($i=0; $i <= ($criteriaCount-1); $i++) {
								echo "<th  class='text-center'>".round($jmlmpb[$i],5)."</th>";
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
		<h4 class="text-center mb-3">Matriks Nilai Kriteria</h4>
		<div class="table-responsive">
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th class="text-center">Kriteria</th>
						<?php
							for ($i=0; $i <= ($criteriaCount-1); $i++) {
								echo "<th class='text-center'>".getKriteriaNama($i)."</th>";
							}
						?>
						<th class="text-center">Jumlah</th>
						<th class="text-center">Priority Vector</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					<?php
						for ($x=0; $x <= ($criteriaCount-1); $x++) {
							echo "<tr>";
								echo "<td class='text-center'>".getKriteriaNama($x)."</td>";
									for ($y=0; $y <= ($criteriaCount-1); $y++) {
										echo "<td class='text-center'>".round($matrik[$x][$y],5)."</td>";
									}
								echo "<td class='text-center'>".round($jmlmnk[$x],5)."</td>";
								echo "<td class='text-center'>".round($pv[$x],5)."</td>";
							echo "</tr>";
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="<?php echo ($criteriaCount+2)?>">Principe Eigen Vector (λ maks)</th>
						<th class="text-center"><?php echo (round($eigenvektor,5))?></th>
					</tr>
					<tr>
						<th colspan="<?php echo ($criteriaCount+2)?>">Consistency Index</th>
						<th class="text-center"><?php echo (round($consIndex,5))?></th>
					</tr>
					<tr>
						<th colspan="<?php echo ($criteriaCount+2)?>">Consistency Ratio</th>
						<th class="text-center"><?php echo (round(($consRatio * 100),2))?> %</th>
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
	</div>
</section>
  <?php
	}
	?>
@endsection
