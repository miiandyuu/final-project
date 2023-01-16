@extends('layouts.dashboard.master')

@section('page-title', 'Kriteria Index')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4 class="text-center mb-3">Kriteria</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border border-bottom-0 shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Halaman Kriteria</p>
        <div>
          @can('is_staff_or_admin')
          <a href="{{ route('kriteria.create') }}"><button class="btn btn-success">Tambah Kriteria</button></a>
          @endcan
          <a href="{{ route('subkriteria.index') }}"><button class="btn btn-warning">Lanjut Subkriteria <i
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
          <th class="text-center">Kriteria</th>
          <th class="text-center">Nama</th>
          <th class="text-center">Kode Database</th>
          <th class="text-center">Keterangan</th>
          <th class="text-center">Tipe</th>
          <th class="text-center">Bobot</th>
          @can('is_staff_or_admin')
          <th class="text-center">Aksi</th>
          @endcan
        </tr>
      </thead>
      <tbody class="bg-white">
        @foreach ($allKriteria as $kriteria)
          <tr>
            <td>C{{ $kriteria->code }}</td>
            <td>{{ strtoupper($kriteria->name) }}</td>
            <td>{{ strtoupper($kriteria->kode_database) }}</td>
            {{-- <td>{{ ucwords($kriteria->description) }}</td> --}}
            <td>{{ ucwords($kriteria->type) }}</td>
            <td>{{ $kriteria->bobot }}</td>
            @can('is_staff_or_admin')
            <td>
              <div class="d-flex justify-content-around">
                {{-- Update --}}
                <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="me-3">
                  <i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="edit"></i>Ubah
                </a>
                {{-- Delete --}}
                <form onsubmit="return confirm('Ingin Menghapus Kriteria {{ strtoupper($kriteria->name) }} ?');"
                  action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="bg-transparent border-0 text-danger">
                    <i class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="trash"></i>Hapus
                  </button>
                </form>
              </div>
            </td>
            @endcan
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
