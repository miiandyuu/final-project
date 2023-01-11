<?php

namespace App\Http\Livewire\Form\NilaiBobot;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateSingle extends Component
{
    public $selectedAlternatif = null;
    public $selectedKriteria = null;
    public $selectedSubkriteria = null;
    public $allSubkriteriaByKriteriaId = [];

    protected $rules = [
        'selectedAlternatif' => ['required', 'numeric'],
        'selectedKriteria' => ['required', 'numeric'],
        'selectedSubkriteria' => ['required', 'numeric', 'between:1,5'],
    ];

    public function render()
    {
        $allAlternatif = DB::table('alternatif')->select('id', 'code_saham', 'name_saham')->get();
        $allKriteria = DB::table('kriteria')->select('id', 'name')->get();

        return view('livewire.form.nilai-bobot.create-single', compact('allAlternatif', 'allKriteria'));
    }

    public function updatedSelectedKriteria($kriteria_id)
    {
        if (!empty($kriteria_id)) {
            $this->allSubkriteriaByKriteriaId = DB::table('subkriteria')->where('kriteria_id', '=', $kriteria_id)->get();
            // Convert to Array for Avoid Bug Non-Object
            $this->allSubkriteriaByKriteriaId->transform(function ($i) {
                return (array) $i;
            });
            $this->allSubkriteriaByKriteriaId->toArray();
        } else {
            $this->allSubkriteriaByKriteriaId = [];
        }
    }

    public function submit()
    {
        $this->validate();

        $data = [
            'kriteria' => $this->selectedKriteria,
            'subkriteria' => $this->selectedSubkriteria,
            'alternatif' => $this->selectedAlternatif
        ];

        $this->store($data);
    }

    protected function store($data)
    {
        $store = DB::table('nilai_bobot')->insert([
            'nilai' => $data['subkriteria'],
            'kriteria_id' => $data['kriteria'],
            'alternatif_id' => $data['alternatif'],
        ]);

        if ($store) {
            return redirect()
                ->route('nilai-bobot.index')
                ->with([
                    'success' => 'Nilai Bobot berhasil dibuat'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Nilai Bobot gagal dibuat'
                ]);
        }
    }
}
