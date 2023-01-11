<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class AlternatifController extends Controller
{
    public function index()
    {
        $allAlternatif = Alternatif::all();

        $coba = Kriteria::select('kode_database')->pluck('kode_database');
        foreach ($coba as $value) {
            
        }
        // echo $coba;
        // dd($coba);
        $test = DB::table('master')->get($value);
        // $a=array();
        // foreach ($test as $final) {
        //     foreach ($final as $result ) {
        //         $a[] = $result;
        //     }
        // }
        return view('dashboard.alternatif.index', compact('allAlternatif', 'a'));
    }

    public function create()
    {
        return view('dashboard.alternatif.create');
    }

    public function store(Request $request)
    {
        $this->validator($request);

        $lastValueCode = DB::table('alternatif')->orderBy('code', 'desc')->first();
        $code = is_null($lastValueCode) ? 1 : $lastValueCode->code + 1;

        $alternatif = Alternatif::create([
            'code' => $code,
            'code_saham' => $request->codeSaham,
            'name_saham' => $request->nameSaham,
        ]);

        if ($alternatif) {
            return redirect()
                ->route('alternatif.index')
                ->with([
                    'success' => 'Alternatif berhasil dibuat'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Alternatif gagal dibuat'
                ]);
        }
    }

    public function edit($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        return view('dashboard.alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, $id)
    {
        $this->validator($request);

        $alternatif = Alternatif::findOrFail($id);

        $alternatif->update([
            'code_saham' => $request->codeSaham,
            'name_saham' => $request->nameSaham,
        ]);

        if ($alternatif) {
            return redirect()
                ->route('alternatif.index')
                ->with([
                    'success' => 'Alternatif berhasil diubah'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Alternatif gagal diubah'
                ]);
        }
    }

    public function destroy($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        if ($alternatif) {
            return redirect()
                ->route('alternatif.index')
                ->with([
                    'success' => 'Alternatif berhasil dihapus'
                ]);
        } else {
            return redirect()
                ->route('alternatif.index')
                ->with([
                    'error' => 'Alternatif gagal dihapus'
                ]);
        }
    }

    protected function validator(Request $request)
    {
        return $request->validate([
            'codeSaham' => ['required', 'string', 'size:4'],
            'nameSaham' => ['required', 'string', 'max:255'],
        ]);
    }
}
