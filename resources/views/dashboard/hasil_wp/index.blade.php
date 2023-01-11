@extends('layouts.dashboard.master')

@section('page-title', 'Hasil S dan V WP')

@section('title')
  <h4 class="text-center mb-3">Hasil S dan V</h4>
@endsection

@section('content')
  @if ($checkHasEmptyData)
    @include('layouts.partial.empty-result')
  @else
    <section class="header-menu mb-3">
      <div class="card m-0 border shadow-none">
        <div class="card-body d-flex align-items-center justify-content-between">
          <p class="m-0">Hasil S dan V</p>
          <a href="{{ route('wp.hasil') }}"><button class="btn btn-success">Lihat Hasil Perankingan</button></a>
        </div>
      </div>
    </section>

    <section class="header-menu mb-3">
      <div class="card m-0 border shadow-none p-3">
        <h4 class="text-center mb-3">Bobot Ternormalisasi</h4>
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kriteria</th>
                <th class="text-center">Bobot</th>
                <th class="text-center">Type</th>
                <th class="text-center">Bobot Ternormalisasi</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              @foreach ($bobotTernormalisasi as $index=>$item)
                <tr>
                  <td class="text-center">{{ ($index + 1) }}</td>
                  <td class="text-center">{{ ucwords($item['description']) }} ({{ strtoupper($item['name']) }})</td>
                  <td class="text-center">{{ $item['bobot'] }}</td>
                  <td class="text-center">{{ ucwords($item['type']) }}</td>
                  <td class="text-center">{{ round($item['bobot_ternormalisasi'], 5) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <section class="header-menu mb-3">
      <div class="card m-0 border shadow-none p-3">
        <h4 class="text-center mb-3">Hasil Vektor S dan V</h4>
        <hr>
        <div class="table-responsive">
          <table class="table table-bordered table-hover mb-0">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Alternatif</th>
                <th class="text-center">Vektor S</th>
                <th class="text-center">Vektor V</th>
              </tr>
            </thead>
            <tbody class="bg-white">
              @for ($i = 0; $i < count($vektorV); $i++)
                <tr>
                  <td class="text-center">{{ ($i + 1) }}</td>
                  <td class="text-center">A{{ $vektorV[$i]['alternatif_code'] }}</td>
                  <td class="text-center">{{ round($vektorS[$i]['vektor_s'], 5) }}</td>
                  <td class="text-center">{{ round($vektorV[$i]['vektor_v'], 5) }}</td>
                </tr>
              @endfor
              <tr>
                <td class="text-center" colspan="2"><b>Total</b></td>
                <td class="text-center">{{ round(array_sum(array_column($vektorS, 'vektor_s')), 5) }}</td>
                <td class="text-center">{{ round(array_sum(array_column($vektorV, 'vektor_v')), 5) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  @endif
@endsection
