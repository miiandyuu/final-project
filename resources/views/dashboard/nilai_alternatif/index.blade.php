@extends('layouts.dashboard.master')

@section('page-title', 'Nilai Alternatif')

@section('notification')
  @include('layouts.partial.notification')
@endsection

@section('title')
  <h4 class="text-center mb-3">Nilai Alternatif</h4>
@endsection

@section('content')
@php
    $query = DB::select("SELECT a1.kode_database,a1.code, a1.id as alternatif_id
    FROM alternatif a1
    LIMIT 10
    ");

    $data_kriteria = DB::select("SELECT c1.code, c1.name, c1.id
    FROM kriteria c1
    ");

@endphp
<section class="header-menu mb-3">
    <div class="card m-0 border shadow-none p-3">
      <h4 class="text-center mb-3">Inputkan Nilai Alternatif !</h4>
      <div class="table-responsive">
        <form action="{{ route('hasil_spk') }}" method="POST">
         @csrf
            <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nama Alternatif</th>
                    @foreach ($data_kriteria as $b )
                        <th>{{ $b->name }}</th>
                    @endforeach
                </tr>
            </thead>
            @foreach ($query as $a)
                                <tr>
                                    <td>{{ $a->kode_database }}</td>
                                    {{-- <input type="hidden" name="jenis_bansos_id" value="{{ $jenis_bansos_id }}" class="form-control"> --}}
                                    @foreach ($data_kriteria as $b)
                                        <td>
                                            @php
                                                $data_sub_kriteria = DB::select("SELECT *
                                                FROM subkriteria
                                                WHERE kriteria_id = $b->id");
                                            @endphp
                                            <input type="hidden" name="alternatif_id[]" value="{{ $a->alternatif_id }}" class="form-control">
                                            <input type="hidden" name="kriteria_id[]" value="{{ $b->id }}" class="form-control">
                                            <select name="sub_kriteria_id[]" id="sub_kriteria_id" class="form-control" required>
                                                {{-- <option value=""> -- Pilih --</option> --}}
                                                @foreach ($data_sub_kriteria as $c )
                                                    <option value="{{ $c->id}}">{{ $c->nama_sub_kriteria }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
            </table>
            <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </form>
      </div>
    </div>
  </section>
@endsection
