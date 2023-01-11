<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KriteriaController extends Controller
{
    public function index()
    {
        $allKriteria = Kriteria::all();
        return view('dashboard.kriteria.index', compact('allKriteria'));
    }

    public function create()
    {
        $this->authorize('is_staff_or_admin');
        $test = Schema::getColumnListing('master');

        return view('dashboard.kriteria.create', compact('test'));
    }

    public function store(Request $request)
    {
        $this->authorize('is_staff_or_admin');

        $this->validator($request);

        $lastValueCode = DB::table('kriteria')->orderBy('code', 'desc')->first();
        $code = is_null($lastValueCode) ? 1 : $lastValueCode->code + 1;
        $bobot = (float)$request->bobot;
        $test = Schema::getColumnListing('master');
        foreach ($test as $key => $value) {
            $value;
        }

        $kriteria = Kriteria::create([
            'code' => $code,
            'name' => $request->name,
            'kode_database' => $value,
            'description' => $request->description,
            'type' => $request->type,
            'bobot' => $bobot,
        ]);

        if ($kriteria) {
            return redirect()
                ->route('kriteria.index')
                ->with([
                    'success' => 'Kriteria berhasil dibuat'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Kriteria gagal dibuat'
                ]);
        }
    }

    public function edit($id)
    {
        $this->authorize('is_staff_or_admin');

        $kriteria = Kriteria::findOrFail($id);
        return view('dashboard.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('is_staff_or_admin');

        $this->validator($request);

        $kriteria = Kriteria::findOrFail($id);
        $bobot = (float)$request->bobot;

        $kriteria->update([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'bobot' => $bobot,
        ]);

        if ($kriteria) {
            return redirect()
                ->route('kriteria.index')
                ->with([
                    'success' => 'Kriteria berhasil diubah'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Kriteria gagal diubah'
                ]);
        }
    }

    public function destroy($id)
    {
        $this->authorize('is_staff_or_admin');

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        if ($kriteria) {
            return redirect()
                ->route('kriteria.index')
                ->with([
                    'success' => 'Kriteria berhasil dihapus'
                ]);
        } else {
            return redirect()
                ->route('kriteria.index')
                ->with([
                    'error' => 'Kriteria gagal dihapus'
                ]);
        }
    }

    protected function validator(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255', "regex:(benefit|cost)"],
            'bobot' => ['required', 'numeric', 'between:1,10'],
        ]);
    }
}
