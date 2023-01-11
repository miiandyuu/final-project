@extends('layouts.dashboard.master')

@section('page-title', 'Dashboard Admin')

@section('title')
  <h4 class="text-center mb-3">Halaman Utama</h4>
@endsection

@section('content')
  <div id="dashboard-content" class="d-flex flex-column justify-content-center align-items-center">
    <img src="{{ asset('images/dashboard-tutorial.svg') }}" alt="Dashboard Admin" style="height: 300px" class="img-fluid">
    <div class="d-flex justify-content-center align-items-center">
      @can('is_staff_or_admin')
        <a href="{{ route('kriteria.index') }}"><button class="btn btn-warning mt-4">Menuju Perhitungan <i
              class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="arrow-right"></i></button></a>
        <a href="{{ route('dashboard.petunjuk') }}"><button class="btn btn-warning mt-4 ms-2">Menuju Petunjuk <i
              class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="arrow-right"></i></button></a>
      @else
        <a href="{{ route('alternatif.index') }}"><button class="btn btn-warning mt-4">Menuju Perhitungan <i
              class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="arrow-right"></i></button></a>
        <a href="{{ route('dashboard.petunjuk') }}"><button class="btn btn-warning mt-4 ms-2">Menuju Petunjuk <i
              class="badge-circle badge-circle-light-secondary font-medium-1" data-feather="arrow-right"></i></button></a>
      @endcan
    </div>
  </div>
@endsection
