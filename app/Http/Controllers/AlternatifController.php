<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class AlternatifController extends Controller
{
    public function index()
    {
        $allAlternatif = Alternatif::paginate(10);

        return view('dashboard.alternatif.index', compact('allAlternatif'));
    }

    public function create()
    {
        $test = Schema::getColumnListing('master');
        $altIsEmpty = Alternatif::get()->isEmpty();


        return view('dashboard.alternatif.create', compact('test', 'altIsEmpty'));
    }

    public function store(Request $request)
    {
        $this->validator($request);
        DB::table('alternatif')->delete();
        DB::statement("ALTER TABLE alternatif AUTO_INCREMENT = 1;");
        $lastValueCode = DB::table('alternatif')->orderBy('code', 'desc')->first();
        $code = is_null($lastValueCode) ? 1 : $lastValueCode->code + 1;

        $result = DB::table('master')->pluck($request->kode_database);
        $data=[];
        foreach ($result as $value) {
            $data[] = [
                'code'=> $code,
                'kode_database' => $value,
            ];
            $code++;
        }
       $alternatif = Alternatif::insert($data);

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
            'kode_database' => $request->kode_database,
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
            'kode_database' => ['required', 'string', 'max:255'],
        ]);
    }
}
