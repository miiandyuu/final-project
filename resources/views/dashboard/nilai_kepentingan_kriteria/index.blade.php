@extends('layouts.dashboard.master')

@section('page-title', 'Perbandingan Kriteria')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4 class="text-center mb-3">Perbandingan Kriteria</h4>
@endsection

@section('content')
<div class="container-fluid">
    <section class="header-menu">
        <div class="card m-0 border border-bottom-0 shadow-none">
          <div class="card-body d-flex align-items-center justify-content-between">
            <p class="m-0">Halaman Perbandingan Kriteria</p>
            <div>
              <a href="{{ route('nilai-bobot.index') }}"><button class="btn btn-warning">Lanjut Nilai Bobot<i
                class="badge-circle badge-circle-light-secondary font-medium-1"
                data-feather="arrow-right"></i></button></a>
            </div>
          </div>
        </div>
      </section>
      <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="card card-table" style="overflow-x: scroll; box-shadow: none" >
                <div class="card-body booking_card">
                    <form action="{{ route('hasil_pv_alternatif') }}" method="POST">
                        @csrf
                        <table  class="table table-bordered table-sm"  width="100%" cellspacing="0">
                            <thead class="table table-bordered">
                                <tr>
                                    <th colspan="2" class="text-center">Pilih yang lebih penting</th>
                                    <th class="text-center">Nilai perbandingan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    foreach ($allKriteria as $kriteria) {
                                        $choices[] = $kriteria->kode_database;
                                    }
                                @endphp
                                <?php
                                $urut = 0;
                                for ($x = 0; $x <= ($criteriaCount - 2); $x++) {
                                    for ($y = ($x + 1); $y <= ($criteriaCount - 1); $y++) {
                                        $urut++;
                                ?>
                                        <tr>
                                            <td>
                                                <div class="radio">
                                                    <label>
                                                        <input name="pilih<?php echo $urut ?>" value="1" checked="" type="radio" class=""> <?php echo $choices[$x]; ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="radio">
                                                    <label>
                                                        <input name="pilih<?php echo $urut ?>" value="2" type="radio" class=""> <?php echo $choices[$y]; ?>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="field">
                                                    <?php
                                                    $nilai = getNilaiPerbandinganKriteria($x, $y);
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
                        <input type="text" name="jenis" value="kriteria" hidden>
                        @if ($criteriaCount > 0)
                            <input class="btn btn-sm btn-primary" type="submit" name="submit" value="SUBMIT">
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card card-table" style="box-shadow: none">
                <div class="card-body booking_card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="" width="100%" cellspacing="0">
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
