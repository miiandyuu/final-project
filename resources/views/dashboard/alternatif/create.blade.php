@extends('layouts.dashboard.master')

@section('page-title', 'Alternatif Create')

@section('title')
  <h4>Alternatif</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border border-bottom-0 shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Pilih Alternatif</p>
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
                    @if ($altIsEmpty != true)
                    <div class="alert alert-danger" role="alert">
                      <h4 class="alert-heading">Read Me!</h4>
                      <p>Anda sudah memilih data alternatif. Sistem hanya dapat memilih satu jenis alternatif dikarenakan banyaknya jumlah data yang digunakan.</p>
                      <hr>
                      <p class="mb-0">Jika anda memilih data alternatif baru, maka seluruh data alternatif lama akan terhapus</p>
                    </div>
                    @endif
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
                    <div class="col-12 d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary me-1 mb-1">Pilih Data</button>
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
