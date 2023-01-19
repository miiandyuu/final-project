@extends('layouts.dashboard.master')

@section('page-title', 'Hasil Perankingan AHP')

@section('title')
  <h4>Hasil Perankingan</h4>
@endsection

@section('content')
  @if ($checkHasEmptyData)
    @include('layouts.partial.empty-result')
  @else
    <section class="header-menu mb-3">
      <div class="card m-0 border shadow-none">
        <div class="card-body d-flex align-items-center justify-content-between">
          <p class="m-0">Hasil Perangkingan</p>
          <a href="{{ route('ahp.index') }}"><button class="btn btn-success">Lihat Matriks Ternormalisasi</button></a>
        </div>
      </div>
    </section>
        <div class="card card-table" style="box-shadow: none">
            <div class="card-body booking_card">
                <div class="card-body">
                    <div>
                        @php
                            // $data = DB::table('jenis_bansos')->where('id', $jenis_bansos_id)->first();
                            // $nama_jenis_bansos =  $data->nama_jenis_bansos;
                        @endphp

                        <h5>Rangking Alternatif Dengan AHP</h5>
                        @php
                            $list = DB::select("SELECT rangking_ahp.*, alternatif.kode_database From rangking_ahp join alternatif on alternatif.id = rangking_ahp.alternatif_id order by nilai_prioritas DESC");
                            foreach ($list as $row) {
                                        $labels[] = $row->kode_database;
										$nilai_prioritas[] = $row->nilai_prioritas;
                            }
                        @endphp
                        <table class="table table-bordered" id="" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Rangking</th>
                                    <th>Nama Alternatif</th>
                                    <th>Nilai Prioritas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $row )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->kode_database }}</td>
                                        <td>{{ $row->nilai_prioritas }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @php
                            //   $query = DB::select("SELECT * FROM rangking join alternatif on alternatif.id = rangking.alternatif_id where rangking.jenis_bansos_id='$jenis_bansos_id' order by nilai_prioritas DESC");
                            //   dd($query);

                                $data = DB::table('rangking_ahp')
                                ->join('alternatif', 'rangking_ahp.alternatif_id', '=', 'alternatif.id')
                                ->orderBy('nilai_prioritas', 'desc')
                                // ->where('jenis_bansos_id',$jenis_bansos_id)
                                ->first();
                                $hasil =  $data->kode_database;


                            //   $nama_alternatif =  $data->nama_alternatif;
                        @endphp
                        <p> <b>Kesimpulan : </b> Jadi, wisma yang disarankan system adalah <b><u>"{{ $hasil }}"</u></b></p>
                    </div>
                </div>
            </div>
        </div>
  @endif
@endsection
