@extends('layouts.dashboard.master')

@section('page-title', 'Alternatif Index')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4 class="text-center mb-3">Alternatif</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border border-bottom-0 shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Halaman Alternatif</p>
        <div>
          <a href="{{ route('alternatif.create') }}"><button class="btn btn-success">Tambah Alternatif</button></a>
          <a href="{{ route('alternatif.create') }}"><button class="btn btn-success">Pilih Alternatif</button></a>
          <a href="{{ route('nilai-bobot.index') }}"><button class="btn btn-warning">Lanjut Nilai Bobot <i
            class="badge-circle badge-circle-light-secondary font-medium-1"
            data-feather="arrow-right"></i></button></a>
        </div>
      </div>
    </div>
  </section>
  <!-- table bordered -->
  <div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
      <thead>
        <tr>
          <th class="text-center">Alternatif</th>
          <th class="text-center">Code Saham</th>
          <th class="text-center">Nama Saham</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="bg-white">
        @foreach ($allAlternatif as $alternatif)
          <tr>
            <td>A{{ $alternatif->code }}</td>
            @foreach ($a as $test)
              <td>{{ $test }}</td>
            @endforeach
            <td>{{ strtoupper($alternatif->code_saham) }}</td>
            <td>{{ ucwords($alternatif->name_saham) }}</td>
            <td>
              <div class="d-flex justify-content-around">
                {{-- Update --}}
                <a href="{{ route('alternatif.edit', $alternatif->id) }}" class="me-3">
                  <i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="edit"></i>Ubah
                </a>
                {{-- Delete --}}
                <form onsubmit="return confirm('Ingin Menghapus Alternatif {{ strtoupper($alternatif->code_saham) }} ?');"
                  action="{{ route('alternatif.destroy', $alternatif->id) }}" method="POST">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="bg-transparent border-0 text-danger">
                    <i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="trash"></i>Hapus
                  </button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
