@extends('layouts.dashboard.master')

@section('page-title', 'Hasil Perankingan TOPSIS')

@section('title')
    <h4 class="text-center mb-3">Hasil Perankingan TOPSIS</h4>
@endsection

@section('content')
{{ show_msg() }}

<section class="header-menu mb-3">
    <div class="card m-0 border shadow-none p-3">
        <h4 class="text-center mb-3">Hasil Perankingan</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover m-0">
                <thead>
                    <tr>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Rank</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($topsis->rank as $key => $val)
                    <tr>
                        <td class="text-center">A{{ $key }}</td>
                        <td class="text-center">{{ $alternatifs[$key]->kode_database }}</td>
                        <td class="text-center">{{ round($topsis->pref[$key], 4) }}</td>
                        <td class="text-center">{{ $val }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection