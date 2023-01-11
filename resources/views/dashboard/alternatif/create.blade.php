@extends('layouts.dashboard.master')

@section('page-title', 'Alternatif Create')

@section('title')
  <h4>Alternatif</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border border-bottom-0 shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Tambah Alternatif</p>
        <a href="{{ route('alternatif.index') }}"><button class="btn btn-secondary">Kembali</button></a>
      </div>
    </div>
  </section>

  <section id="basic-vertical-layouts">
    <div class="row match-height">
      <div class="col-12">
        <div class="card m-0 border shadow-none">
          <div class="card-content">
            <div class="card-body">
              <form class="form form-vertical" action="{{ route('alternatif.store') }}" method="POST">
                @csrf
                <div class="form-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="codeSaham">Code Saham</label>
                        <input type="text" id="codeSaham" class="form-control @error('codeSaham') is-invalid @enderror"
                          name="codeSaham" placeholder="4 Character" required>
                      </div>
                      @error('codeSaham')
                        @include('layouts.partial.invalid-form', ['message' => $message])
                      @enderror
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="nameSaham">Nama Saham</label>
                        <input type="text" id="nameSaham" class="form-control @error('nameSaham') is-invalid @enderror"
                          name="nameSaham" required>
                      </div>
                      @error('nameSaham')
                        @include('layouts.partial.invalid-form', ['message' => $message])
                      @enderror
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary me-1 mb-1">Tambah Data</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
