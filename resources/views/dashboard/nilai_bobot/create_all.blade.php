@extends('layouts.dashboard.master')

@section('page-title', 'Nilai Bobot Create All')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4>Tambah Nilai Bobot Semua</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border border-bottom-0 shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Tambah Nilai Bobot Semua</p>
        <div>
          <a href="{{ route('nilai-bobot.create_single') }}"><button class="btn btn-success">Ke Tambah Sebagian</button></a>
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
              <form class="form form-vertical" action="{{ route('nilai-bobot.store_all') }}" method="POST">
                @csrf
                <div class="form-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="alternatif">Alternatif</label>
                        <select class="form-select @error('alternatif') is-invalid @enderror" id="alternatif"
                          name="alternatif" required>
                          <option value="" selected>Pilih Alternatif...</option>
                          @foreach ($allAlternatif as $alternatif)
                            <option value='{{ $alternatif->id }}'>{{ ucwords($alternatif->name_saham) }}
                              ({{ strtoupper($alternatif->code_saham) }})
                            </option>
                          @endforeach
                        </select>
                        @error('alternatif')
                          @include('layouts.partial.invalid-form', ['message' => $message])
                        @enderror
                      </div>
                      <h4 class="text-center">Kriteria</h4>
                      <div class="row match-height mb-3">
                        <div class="col-12">
                          <div class="card m-0 border shadow-none">
                            <div class="card-content">
                              <div class="card-body">
                                @foreach ($allKriteria as $key => $kriteria)
                                  <input type="hidden" name="kriteria[]" value={{ $kriteria->id }}>
                                  <div class="form-group">
                                    <label for="nilai">{{ strtoupper($kriteria->name) }}</label>
                                    <select class="form-select @error('nilai.' . $key) is-invalid @enderror"
                                      id="nilai" name="nilai[]" required>
                                      <option value="" selected>Pilih Nilai...</option>
                                      @foreach ($allSubkriteria as $subkriteria)
                                        @if ($kriteria->id == $subkriteria->kriteria_id)
                                          <option value="{{ $subkriteria->nilai }}">{{ $subkriteria->range }}</option>
                                        @endif
                                      @endforeach
                                    </select>
                                    @error('nilai.' . $key)
                                      @include('layouts.partial.invalid-form', ['message' => $message])
                                    @enderror
                                  </div>
                                @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
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
