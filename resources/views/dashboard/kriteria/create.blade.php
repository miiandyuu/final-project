@extends('layouts.dashboard.master')

@section('page-title', 'Kriteria Create')

@section('title')
  <h4>Kriteria</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border border-bottom-0 shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Tambah Kriteria</p>
        <a href="{{ route('kriteria.index') }}"><button class="btn btn-secondary">Kembali</button></a>
      </div>
    </div>
  </section>

  <section id="basic-vertical-layouts">
    <div class="row match-height">
      <div class="col-12">
        <div class="card m-0 border shadow-none">
          <div class="card-content">
            <div class="card-body">
              <form class="form form-vertical" action="{{ route('kriteria.store') }}" method="POST">
                @csrf
                <div class="form-body">
                  <div class="row">
                    
                    <div class="col-12">
                      <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                          name="name" placeholder="Singkatan Nama" required>
                        @error('name')
                          @include('layouts.partial.invalid-form', ['message' => $message])
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label for="kode_database">Kode Database</label>
                        <select class="form-select @error('kode_database') is-invalid @enderror" id="kode_database" name="kode_database"
                          required>
                          @foreach ($test as $item)
                              <option value="{{ $item }}">{{ $item }}</option>
                          @endforeach
                        </select>
                        @error('kode_database')
                          @include('layouts.partial.invalid-form', ['message' => $message])
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label for="type">Tipe</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type"
                          required>
                          <option value="cost">Cost</option>
                          <option value="benefit">Benefit</option>
                        </select>
                        @error('type')
                          @include('layouts.partial.invalid-form', ['message' => $message])
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label for="bobot">Bobot</label>
                        <select class="form-select @error('bobot') is-invalid @enderror" id="bobot" name="bobot"
                          required>
                          @for ($i = 1; $i <= 10; $i++)
                            <option value='{{ $i }}'>{{ $i }}</option>
                          @endfor
                        </select>
                        @error('bobot')
                          @include('layouts.partial.invalid-form', ['message' => $message])
                        @enderror
                      </div>
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
