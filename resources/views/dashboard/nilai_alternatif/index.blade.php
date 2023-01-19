@extends('layouts.master')
@section('title', 'Nilai Alternatif')
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
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table">
            <div class="card-body booking_card">
                <div class="card-body">
                    <div class="table-responsive">

                        <h5>Inputkan Nilai Alternatif !!!</h5>
                        <form action="{{ route('hasil_spk') }}" method="POST">
                        @csrf
                        <table class="table table-bordered" >
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
            </div>
        </div>
    </div>
</div>


@endsection
