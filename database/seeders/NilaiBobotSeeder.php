<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiBobot;
use Illuminate\Database\Seeder;

class NilaiBobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allKriteria = Kriteria::all();
        $allAlternatif = Alternatif::all();
        // Urutan Kriteria => NPM | ROA | ROE | EPS | PER | DER | PBV
        // Urutan Sesuai Excel
        $data = [
            'alternatif1' => [2, 2, 2, 5, 2, 1, 3],
            'alternatif2' => [3, 2, 3, 1, 5, 1, 5],
            'alternatif3' => [1, 1, 1, 1, 5, 5, 2],
            'alternatif4' => [5, 3, 5, 5, 2, 2, 3],
            'alternatif5' => [2, 1, 2, 1, 5, 4, 3],
            'alternatif6' => [1, 1, 3, 3, 3, 1, 5],
            'alternatif7' => [1, 2, 2, 1, 5, 1, 5],
            'alternatif8' => [3, 1, 1, 1, 1, 4, 2],
            'alternatif9' => [1, 1, 1, 1, 5, 3, 2],
            'alternatif10' => [5, 1, 1, 1, 1, 1, 5],
            'alternatif11' => [5, 1, 1, 1, 1, 2, 1],
            'alternatif12' => [1, 1, 1, 1, 5, 1, 3],
            'alternatif13' => [4, 1, 2, 1, 1, 2, 2],
            'alternatif14' => [4, 1, 3, 1, 5, 1, 5],
            'alternatif15' => [2, 1, 2, 1, 5, 5, 5],
            'alternatif16' => [5, 1, 1, 1, 4, 2, 3],
            'alternatif17' => [5, 1, 1, 1, 1, 1, 5],
            'alternatif18' => [4, 3, 4, 1, 5, 1, 5],
            'alternatif19' => [2, 3, 3, 3, 5, 1, 5],
            'alternatif20' => [5, 1, 3, 1, 3, 2, 4],
            'alternatif21' => [5, 3, 3, 1, 3, 1, 5],
            'alternatif22' => [1, 1, 1, 1, 4, 2, 2],
            'alternatif23' => [5, 3, 4, 1, 5, 1, 5],
            'alternatif24' => [1, 2, 4, 1, 2, 1, 5],
            'alternatif25' => [1, 1, 2, 2, 5, 2, 5],
            'alternatif26' => [3, 1, 1, 1, 5, 1, 5],
            'alternatif27' => [1, 1, 1, 1, 5, 3, 2],
            'alternatif28' => [5, 3, 5, 1, 4, 2, 5],
            'alternatif29' => [1, 1, 1, 1, 5, 2, 5],
            'alternatif30' => [5, 2, 4, 4, 5, 1, 5],
            'alternatif31' => [3, 2, 4, 5, 4, 4, 5],
            'alternatif32' => [1, 1, 1, 1, 1, 3, 5],
            'alternatif33' => [4, 2, 1, 3, 4, 1, 5],
            'alternatif34' => [3, 1, 4, 5, 2, 4, 4],
            'alternatif35' => [3, 2, 3, 5, 2, 3, 3],
            'alternatif36' => [3, 2, 2, 5, 5, 1, 5],
            'alternatif37' => [1, 1, 1, 1, 5, 1, 3],
            'alternatif38' => [2, 3, 5, 1, 5, 1, 5],
            'alternatif39' => [5, 3, 5, 5, 1, 5, 5],
            'alternatif40' => [5, 5, 5, 5, 1, 1, 4],
            'alternatif41' => [1, 2, 4, 2, 2, 3, 5],
            'alternatif42' => [5, 2, 3, 1, 2, 1, 3],
            'alternatif43' => [1, 1, 1, 1, 5, 4, 5],
            'alternatif44' => [1, 1, 1, 1, 5, 3, 4],
            'alternatif45' => [3, 3, 4, 1, 5, 1, 5],
            'alternatif46' => [5, 1, 1, 1, 5, 1, 2],
            'alternatif47' => [4, 2, 4, 4, 3, 3, 5],
            'alternatif48' => [3, 1, 1, 1, 1, 4, 2],
            'alternatif49' => [4, 4, 5, 4, 3, 1, 5],
            'alternatif50' => [5, 2, 2, 2, 2, 1, 2],
            'alternatif51' => [1, 1, 2, 1, 5, 1, 5],
            'alternatif52' => [2, 1, 1, 1, 5, 2, 5],
            'alternatif53' => [5, 4, 5, 1, 5, 1, 5],
            'alternatif54' => [1, 1, 2, 1, 5, 4, 4],
            'alternatif55' => [5, 3, 3, 2, 2, 1, 2],
            'alternatif56' => [1, 1, 2, 1, 3, 1, 2],
            'alternatif57' => [1, 2, 4, 3, 4, 1, 5],
            'alternatif58' => [1, 2, 3, 1, 5, 2, 5],
            'alternatif59' => [3, 1, 3, 2, 2, 3, 2],
            'alternatif60' => [4, 2, 3, 1, 2, 3, 2],
            'alternatif61' => [5, 5, 5, 5, 1, 1, 4],
            'alternatif62' => [1, 1, 1, 1, 5, 5, 2],
            'alternatif63' => [5, 1, 2, 1, 4, 2, 4],
            'alternatif64' => [1, 1, 1, 1, 5, 4, 2],
            'alternatif65' => [2, 1, 1, 1, 5, 1, 4],
            'alternatif66' => [2, 2, 2, 1, 5, 1, 5],
            'alternatif67' => [5, 3, 5, 1, 4, 1, 5],
            'alternatif68' => [5, 5, 5, 1, 5, 1, 5],
            'alternatif69' => [2, 2, 3, 5, 5, 1, 5],
            'alternatif70' => [2, 1, 2, 1, 2, 3, 2],
            'alternatif71' => [1, 1, 1, 1, 5, 2, 5],
            'alternatif72' => [2, 1, 2, 4, 5, 2, 4],
            'alternatif73' => [2, 1, 1, 1, 5, 3, 5],
            'alternatif74' => [4, 4, 5, 2, 2, 1, 5],
            'alternatif75' => [2, 1, 1, 1, 1, 2, 2],
            'alternatif76' => [4, 2, 4, 1, 2, 2, 5],
            'alternatif77' => [2, 2, 5, 2, 2, 3, 5],
            'alternatif78' => [5, 2, 3, 5, 2, 2, 2],
            'alternatif79' => [5, 2, 5, 3, 4, 2, 5],
            'alternatif80' => [2, 1, 2, 2, 5, 2, 5],
            'alternatif81' => [2, 2, 2, 2, 3, 1, 4],
            'alternatif82' => [4, 4, 5, 2, 3, 1, 5],
            'alternatif83' => [4, 2, 3, 5, 2, 1, 4],
            'alternatif84' => [4, 5, 5, 2, 5, 2, 5],
            'alternatif85' => [2, 1, 2, 1, 2, 1, 3],
            'alternatif86' => [1, 1, 1, 1, 5, 5, 3],
            'alternatif87' => [2, 2, 4, 1, 2, 2, 5],
            'alternatif88' => [2, 2, 3, 1, 2, 1, 5],
            'alternatif89' => [1, 1, 1, 1, 5, 2, 3],
        ];

        foreach ($allAlternatif as $keyAlt => $alternatif) {
            foreach ($allKriteria as $keyKrit => $kriteria) {
                NilaiBobot::create([
                    'nilai' => $data['alternatif' . ($keyAlt + 1)][$keyKrit],
                    'kriteria_id' => $kriteria->id,
                    'alternatif_id' => $alternatif->id
                ]);
            }
        }
    }
}
