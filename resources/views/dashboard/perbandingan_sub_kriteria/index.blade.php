@extends('layouts.dashboard.master')

@section('page-title', 'Perbandingan Sub Kriteria')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4 class="text-center mb-3">Perbandingan Sub Kriteria</h4>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="card card-table" style="overflow-x: scroll; ">
                <div class="card-body booking_card">
                    <h3>KRITERIA &rarr; {{ nama_kriteria_by_id($kriteria_id)}}</h3>
                    <form action="{{ route('hasil_pv_sub_spk') }}" method="post">
                        @csrf
                        <table class="table table-bordered" style="margin-bottom: 10px">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text-center">Pilih yang lebih penting</th>
                                    <th class="text-center">Nilai perbandingan</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $query = DB::select("SELECT nama_sub_kriteria FROM subkriteria where kriteria_id='$kriteria_id'");
                                    if ($query){
                                        foreach ($query as $row) {
                                            $pilihan[] = $row->nama_sub_kriteria;
                                        }
                                    }
                                @endphp

                                <?php
                                $n = DB::table("subkriteria")
                                            ->where('kriteria_id', '=', $kriteria_id)
                                            ->count();

                                $urut = 0;
                                for ($x = 0; $x <= ($n - 2); $x++) {
                                    for ($y = ($x + 1); $y <= ($n - 1); $y++) {
                                        $urut++;
                                ?>
                                        <tr>
                                            <td>
                                                <div class="radio">
                                                    <label>
                                                        <input name="pilih<?php echo $urut ?>" value="1" checked="" type="radio" class=""> <?php echo $pilihan[$x]; ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="radio">
                                                    <label>
                                                        <input name="pilih<?php echo $urut ?>" value="2" type="radio" class=""> <?php echo $pilihan[$y]; ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="field">
                                                    <?php
                                                    $nilai = getNilaiPerbandinganSubKriteria($x, $y,$kriteria_id);
                                                    ?>
                                                    <input type="number" max="12" min="1" class="form-control" name="bobot<?php echo $urut ?>" value="<?php echo $nilai ?>" required>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        <input  type="hidden" name="kriteria_id" value="{{ $kriteria_id }}">
                        <input class="btn btn-primary" type="submit" name="submit" value="SUBMIT">
                    </form>

                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card card-table">
                <div class="card-body booking_card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Keterangan</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Kedua elemen sama pentingnya</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>Elemen yang satu sedikit lebih penting dari pada elemen yang lainnya</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>Elemen yang satu lebih penting dari pada yang lainnya</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>Satu elemen kelas lebih mutlak penting dari pada elemen lainnya</td>
                                        <td>7</td>
                                    </tr>
                                    <tr>
                                        <td>Satu elemen mutlak penting dari pada elemen lainnya</td>
                                        <td>9</td>
                                    </tr>
                                    <tr>
                                        <td>Nilai-nilai antara dua nllai pertimbangan-pertimbangan yang berdekatan</td>
                                        <td>2,4,6,8</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
