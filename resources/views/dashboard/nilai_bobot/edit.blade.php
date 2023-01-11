@extends('layouts.dashboard.master')

@section('page-title', 'Nilai Bobot Edit')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4>Ubah Nilai Bobot</h4>
@endsection

@section('content')
  <section class="header-menu">
    <div class="card m-0 border border-bottom-0 shadow-none">
      <div class="card-body d-flex align-items-center justify-content-between">
        <p class="m-0">Ubah Nilai Bobot</p>
        <div>
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
              <form class="form form-vertical"
                action="{{ route('nilai-bobot.update', $selectedAlternatif[0]->alternatif_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="alternatif">Alternatif</label>
                        <input type="hidden" name="alternatif" id="alternatif"
                          value="{{ $selectedAlternatif[0]->alternatif_id }}">
                        <input type="text" id="alternatif_view"
                          class="form-control @error('alternatif') is-invalid @enderror" name="alternatif_view" readonly
                          value="{{ ucwords($selectedAlternatif[0]->name_saham) }} ({{ strtoupper($selectedAlternatif[0]->code_saham) }})">
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
                                @foreach ($selectedAlternatif as $key => $item)
                                  <input type="hidden" name="kriteria[]" value={{ $item->kriteria_id }}>
                                  <div class="form-group">
                                    <label for="nilai">{{ strtoupper($item->kriteria_name) }}</label>
                                    <select class="form-select @error('nilai.' . $key) is-invalid @enderror"
                                      id="nilai" name="nilai[]" required>
                                      @foreach ($allSubkriteria as $subkriteria)
                                        @if ($item->kriteria_id == $subkriteria->kriteria_id)
                                          <option value="{{ $subkriteria->nilai }}"
                                            {{ $item->nilai == $subkriteria->nilai ? 'selected' : '' }}>
                                            {{ $subkriteria->range }}</option>
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
                      <button type="submit" class="btn btn-primary me-1 mb-1">Ubah Data</button>
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
