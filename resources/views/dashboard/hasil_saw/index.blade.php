@extends('layouts.dashboard.master')

@section('page-title', 'Matriks Ternormalisasi SAW')

@section('title')
  <h4 class="text-center mb-3">Matriks Ternormalisasi (R)</h4>
@endsection

@section('content')
  @if ($checkHasEmptyData)
    @include('layouts.partial.empty-result')
  @else
    <section class="header-menu mb-3">
      <div class="card m-0 border shadow-none">
        <div class="card-body d-flex align-items-center justify-content-between">
          <p class="m-0">Matriks Ternormalisasi (R)</p>
          <a href="{{ route('saw.hasil') }}"><button class="btn btn-success">Lihat Hasil Perankingan</button></a>
        </div>
      </div>
    </section>

    <section class="header-menu mb-3">
      <div class="card m-0 border shadow-none p-3">
        <h4 class="text-center mb-3">Bobot</h4>
        <p><b>Note : </b>Jumlah bobot (W) haruslah 1 / 10 / 100. Di aplikasi ini menggunakan total bobot 10.</p>
        <hr>
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kriteria</th>
                <th class="text-center">Bobot</th>
                <th class="text-center">Type</th>
                <th class="text-center">Persentase Bobot</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              @foreach ($persentaseBobot as $index => $item)
                <tr>
                  <td class="text-center">{{ $index + 1 }}</td>
                  <td class="text-center">{{ ucwords($item['description']) }} ({{ strtoupper($item['name']) }})</td>
                  <td class="text-center">{{ $item['bobot'] }}</td>
                  <td class="text-center">{{ ucwords($item['type']) }}</td>
                  <td class="text-center">{{ round($item['persentase_bobot'], 5) }}</td>
                </tr>
              @endforeach
              <tr>
                <td class="text-center" colspan="4"><b>Total</b></td>
                <td class="text-center">{{ array_sum(array_column($persentaseBobot, 'persentase_bobot')) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <section class="header-menu mb-3">
      <div class="card m-0 border shadow-none p-3">
        <h4 class="text-center mb-3">Matrix Ternormalisasi (R)</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead>
              <tr>
                <th class="text-center" rowspan="2">Alternatif</th>
                <th class="text-center" colspan="{{ count($matrixTernormalisasi[0]) }}">Kriteria</th>
              </tr>
              <tr>
                @foreach ($matrixTernormalisasi[0] as $kriteria)
                  <th class="text-center">{{ strtoupper($kriteria['krit_name']) }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody class="bg-white">
              @for ($i = 0; $i < count($nilaiBobotGroupByAlternatifId); $i++)
                <tr>
                  <td class="text-center">A{{ $nilaiBobotGroupByAlternatifId[$i]->code }}</td>
                  @foreach ($matrixTernormalisasi[$i] as $kriteria)
                    <td class="text-center">{{ round($kriteria['value_r'], 5) }}</td>
                  @endforeach
                </tr>
              @endfor
            </tbody>
          </table>
        </div>
      </div>
    </section>
  @endif
@endsection
