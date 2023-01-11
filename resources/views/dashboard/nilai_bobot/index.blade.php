@extends('layouts.dashboard.master')

@section('page-title', 'Nilai Bobot Index')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4 class="text-center mb-3">Nilai Bobot</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Halaman Nilai Bobot</p>
        <div>
          <a href="{{ route('nilai-bobot.create_all') }}"><button class="btn btn-success">Tambah Nilai Bobot</button></a>
          <a href="{{ route('saw.index') }}"><button class="btn btn-warning">Metode SAW <i
                class="badge-circle badge-circle-light-secondary font-medium-1"
                data-feather="arrow-right"></i></button></a>
          <a href="{{ route('wp.index') }}"><button class="btn btn-warning">Metode WP <i
                class="badge-circle badge-circle-light-secondary font-medium-1"
                data-feather="arrow-right"></i></button></a>
        </div>
      </div>
    </div>
  </section>
  <div>
    <h4 class="text-center my-3">Data Nilai Bobot</h4>
    <div class="table-responsive">
      <table class="table table-bordered table-hover mb-0">
        <thead>
          <tr>
            <th class="text-center p-2" rowspan="2">Alternatif</th>
            <th class="text-center p-2" colspan="{{ count($allKriteria) }}">Kriteria</th>
            <th class="text-center p-2" rowspan="2">Aksi</th>
          </tr>
          <tr>
            @foreach ($allKriteria as $kriteria)
              <th class="text-center p-2">{{ strtoupper($kriteria->name) }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach ($allDataProcessed as $item)
            <tr>
              <td>{{ $item->name_saham }} ({{ $item->code_saham }})</td>
              @for ($i = 0; $i < count($allKriteria); $i++)
                @if (is_string($item->dataKriteria[$i]['nilai']))
                  <td class="text-danger"><i>{{ $item->dataKriteria[$i]['nilai'] }}</i></td>
                @else
                  <td>{{ $item->dataKriteria[$i]['nilai'] }}</td>
                @endif
              @endfor
              <td>
                <a href="{{ route('nilai-bobot.edit', ['alternatif_id' => $item->alternatif_id]) }}" class="me-3">
                  <i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="edit"></i>Ubah
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
