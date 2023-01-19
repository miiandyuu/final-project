@extends('layouts.dashboard.master')

@section('page-title', 'Matriks Ternormalisasi TOPSIS')

@section('title')
  <h4 class="text-center mb-3">Matriks Ternormalisasi (R) TOPSIS</h4>
@endsection

@section('content')
    <section class="header-menu mb-3">
        <div class="card m-0 border shadow-none">
            <div class="card-body d-flex align-items-center justify-content-between">
            <p class="m-0">Matriks Ternormalisasi (R) TOPSIS</p>
            <a href="{{ route('topsis.hasil') }}"><button class="btn btn-success">Lihat Hasil Perankingan TOPSIS</button></a>
            </div>
        </div>
    </section>
    
    <section class="header-menu mb-3">
      <div class="card m-0 border shadow-none p-3">
        <h4 class="text-center mb-3">Kriteria</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover m-0">
                <thead>
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Atribut</th>
                    <th class="text-center">Bobot</th>
                </thead>
                @foreach($kriterias as $key => $val)
                <tr>
                    <td class="text-center">C{{ $key }}</td>
                    <td class="text-center">{{ $val->kode_database }}</td>
                    <td class="text-center">{{ $val->type }}</td>
                    <td class="text-center">{{ round($val->bobot, 4) }}</td>
                </tr>
                @endforeach
            </table>
        </div>
      </div>
    </section>

    <section class="header-menu mb-3">
        <div class="card m-0 border shadow-none p-3">
          <h4 class="text-center mb-3">Data Alternatif</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-hover m-0">
                <thead>
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama</th>
                    @foreach($kriterias as $key => $val)
                    <th class="text-center">{{ $val->kode_database }}</th>
                    @endforeach
                </thead>
                @foreach($rel_alternatif as $key => $val)
                <tr>
                    <td class="text-center">A{{ $key }}</td>
                    <td class="text-center">{{ $alternatifs[$key]->kode_database }}</td>
                    @foreach($val as $k => $v)
                    <td class="text-center">{{ $v }}</td>
                    @endforeach
                </tr>
                @endforeach
            </table>
          </div>
        </div>
    </section>

    <section class="header-menu mb-3">
        <div class="card m-0 border shadow-none p-3">
          <h4 class="text-center mb-3">Normalisasi</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-hover m-0">
                <thead>
                    <th class="text-center">Kode</th>
                    @foreach($kriterias as $key => $val)
                    <th class="text-center">{{ $key }}</th>
                    @endforeach
                </thead>
                @foreach($topsis->normal as $key => $val)
                <tr>
                    <td class="text-center">A{{ $key }}</td>
                    @foreach($val as $k => $v)
                    <td class="text-center">{{ round($v, 4) }}</td>
                    @endforeach
                </tr>
                @endforeach
            </table>
          </div>
        </div>
    </section>

    <section class="header-menu mb-3">
        <div class="card m-0 border shadow-none p-3">
          <h4 class="text-center mb-3">Terbobot</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-hover m-0">
                <thead>
                    <th class="text-center">Kode</th>
                    @foreach($kriterias as $key => $val)
                    <th class="text-center">{{ $key }}</th>
                    @endforeach
                </thead>
                @foreach($topsis->terbobot as $key => $val)
                <tr>
                    <td class="text-center">A{{ $key }}</td>
                    @foreach($val as $k => $v)
                    <td class="text-center">{{ round($v, 4) }}</td>
                    @endforeach
                </tr>
                @endforeach
            </table>
          </div>
        </div>
    </section>

    <section class="header-menu mb-3">
        <div class="card m-0 border shadow-none p-3">
          <h4 class="text-center mb-3">Matriks Solusi Ideal</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-hover m-0">
                <thead>
                    <th class="text-center">Ideal</th>
                    @foreach($kriterias as $key => $val)
                    <th class="text-center">{{ $key }}</th>
                    @endforeach
                </thead>
                @foreach($topsis->solusi_ideal as $key => $val)
                <tr>
                    <td class="text-center">{{ $key }}</td>
                    @foreach($val as $k => $v)
                    <td class="text-center">{{ round($v, 4) }}</td>
                    @endforeach
                </tr>
                @endforeach
            </table>
          </div>
        </div>
    </section>

    <section class="header-menu mb-3">
        <div class="card m-0 border shadow-none p-3">
          <h4 class="text-center mb-3">Jarak Solusi Ideal</h4>
          <div class="table-responsive">
            <table class="table table-bordered table-hover m-0">
                <thead>
                    <tr>
                        <th class="text-center">Kode</th>
                        <th class="text-center">Positif</th>
                        <th class="text-center">Negatif</th>
                        <th class="text-center">Preferensi</th>
                    </tr>
                </thead>
                @foreach($topsis->jarak_solusi as $key => $val)
                <tr>
                    <td class="text-center">A{{ $key }}</td>
                    <td class="text-center">{{ round($val['positif'], 4) }}</td>
                    <td class="text-center">{{ round($val['negatif'], 4) }}</td>
                    <td class="text-center">{{ round($topsis->pref[$key], 4) }}</td>
                </tr>
                @endforeach
            </table>
          </div>
        </div>
    </section>

@endsection
