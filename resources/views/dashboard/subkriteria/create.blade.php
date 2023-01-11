@extends('layouts.dashboard.master')

@section('page-title', 'Subkriteria Create')

@section('title')
  <h4>Subkriteria</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border border-bottom-0 shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Tambah Subkriteria</p>
        <a href="{{ route('subkriteria.index') }}"><button class="btn btn-secondary">Kembali</button></a>
      </div>
    </div>
  </section>

  <section id="basic-vertical-layouts">
    <div class="row match-height">
      <div class="col-12">
        <div class="card m-0 border shadow-none">
          <div class="card-content">
            <div class="card-body">
              @livewire('form.subkriteria.create')
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
