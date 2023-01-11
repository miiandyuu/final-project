@extends('layouts.dashboard.master')

@section('page-title', 'Nilai Bobot Create Some')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4>Tambah Nilai Bobot Sebagian</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border border-bottom-0 shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Tambah Nilai Bobot Sebagian</p>
        <div>
          <a href="{{ route('nilai-bobot.create_all') }}"><button class="btn btn-success">Ke Tambah Semua</button></a>
          <a href="{{ route('nilai-bobot.index') }}"><button class="btn btn-secondary">Kembali</button></a>
        </div>
      </div>
    </div>
  </section>

  <section id="basic-vertical-layouts">
    <div class="row match-height">
      <div class="col-12">
        <div class="card m-0 border shadow-none">
          <div class="card-content">
            <div class="card-body">
              @livewire('form.nilai-bobot.create-single')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
