<?php

namespace App\Http\Controllers;

use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubkriteriaController extends Controller
{
    public function index()
    {
        $allSubkriteria = DB::table('subkriteria')
                            ->join('kriteria', 'subkriteria.kriteria_id', '=', 'kriteria.id')
                            ->select('subkriteria.*', 'kriteria.name')
                            ->orderBy('subkriteria.kriteria_id')
                            ->orderBy('nilai')
                            ->get();
        return view('dashboard.subkriteria.index', compact('allSubkriteria'));
    }

    public function create()
    {
        $this->authorize('is_staff_or_admin');

        return view('dashboard.subkriteria.create');
    }

    public function edit($kriteriaId)
    {
        $this->authorize('is_staff_or_admin');

        return view('dashboard.subkriteria.edit', ['kriteriaId' => $kriteriaId]);
    }
}
