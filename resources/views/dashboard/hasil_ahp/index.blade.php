@extends('layouts.dashboard.master')

@section('page-title', 'Hasil Perankingan AHP')

@section('title')
  <h4 class="text-center mb-3">Hasil Perankingan AHP</h4>
@endsection

@section('content')
<section class="header-menu mb-3">
    <div class="card m-0 border shadow-none p-3">
      <h4 class="text-center mb-3">Hasil Perankingan SAW</h4>
      <div class="table-responsive">
        @php
            $list = DB::select("SELECT rangking_ahp.*,alternatif.kode_database From rangking_ahp join alternatif on alternatif.id = rangking_ahp.alternatif_id order by nilai_prioritas DESC");
            foreach ($list as $row) {
                $labels[] = $row->kode_database;
				$nilai_prioritas[] = $row->nilai_prioritas;
            }
        @endphp
        <table class="table table-bordered table-hover mb-0">
            <thead>
                <tr>
                    <th class="text-center">Nama Alternatif</th>
                    <th class="text-center">Nilai Prioritas</th>
                    <th class="text-center">Rangking</th>
                </tr>
            </thead>
          <tbody class="bg-white">
            @foreach ($list as $row )
                <tr>
                    <td class="text-center">{{ $row->kode_database }}</td>
                    <td class="text-center">{{ $row->nilai_prioritas }}</td>
                    <td class="text-center">{{ $loop->iteration }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection