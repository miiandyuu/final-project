<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Database\Seeder;

class SubkriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['range' => '< 5%', 'nilai' => 1, 'kriteria_id' => Kriteria::find(1)->id],
            ['range' => '5 - 10%', 'nilai' => 2, 'kriteria_id' => Kriteria::find(1)->id],
            ['range' => '10 - 15%', 'nilai' => 3, 'kriteria_id' => Kriteria::find(1)->id],
            ['range' => '15 - 20%', 'nilai' => 4, 'kriteria_id' => Kriteria::find(1)->id],
            ['range' => '> 20%', 'nilai' => 5, 'kriteria_id' => Kriteria::find(1)->id],
            ['range' => '< 5%', 'nilai' => 1, 'kriteria_id' => Kriteria::find(2)->id],
            ['range' => '5 - 10%', 'nilai' => 2, 'kriteria_id' => Kriteria::find(2)->id],
            ['range' => '10 - 15%', 'nilai' => 3, 'kriteria_id' => Kriteria::find(2)->id],
            ['range' => '15 - 20%', 'nilai' => 4, 'kriteria_id' => Kriteria::find(2)->id],
            ['range' => '> 20%', 'nilai' => 5, 'kriteria_id' => Kriteria::find(2)->id],
            ['range' => '< 5%', 'nilai' => 1, 'kriteria_id' => Kriteria::find(3)->id],
            ['range' => '5 - 10%', 'nilai' => 2, 'kriteria_id' => Kriteria::find(3)->id],
            ['range' => '10 - 15%', 'nilai' => 3, 'kriteria_id' => Kriteria::find(3)->id],
            ['range' => '15 - 20%', 'nilai' => 4, 'kriteria_id' => Kriteria::find(3)->id],
            ['range' => '> 20%', 'nilai' => 5, 'kriteria_id' => Kriteria::find(3)->id],
            ['range' => '< 100', 'nilai' => 1, 'kriteria_id' => Kriteria::find(4)->id],
            ['range' => '100 - 200', 'nilai' => 2, 'kriteria_id' => Kriteria::find(4)->id],
            ['range' => '200 - 300', 'nilai' => 3, 'kriteria_id' => Kriteria::find(4)->id],
            ['range' => '300 - 400', 'nilai' => 4, 'kriteria_id' => Kriteria::find(4)->id],
            ['range' => '> 400', 'nilai' => 5, 'kriteria_id' => Kriteria::find(4)->id],
            ['range' => '< 5', 'nilai' => 1, 'kriteria_id' => Kriteria::find(5)->id],
            ['range' => '5 - 10', 'nilai' => 2, 'kriteria_id' => Kriteria::find(5)->id],
            ['range' => '10 - 15', 'nilai' => 3, 'kriteria_id' => Kriteria::find(5)->id],
            ['range' => '15 - 20', 'nilai' => 4, 'kriteria_id' => Kriteria::find(5)->id],
            ['range' => '> 20', 'nilai' => 5, 'kriteria_id' => Kriteria::find(5)->id],
            ['range' => '< 0,3', 'nilai' => 1, 'kriteria_id' => Kriteria::find(6)->id],
            ['range' => '0,31 - 0,6', 'nilai' => 2, 'kriteria_id' => Kriteria::find(6)->id],
            ['range' => '0,61 - 1', 'nilai' => 3, 'kriteria_id' => Kriteria::find(6)->id],
            ['range' => '1,1 - 1,5', 'nilai' => 4, 'kriteria_id' => Kriteria::find(6)->id],
            ['range' => '> 1,5', 'nilai' => 5, 'kriteria_id' => Kriteria::find(6)->id],
            ['range' => '< 0,3', 'nilai' => 1, 'kriteria_id' => Kriteria::find(7)->id],
            ['range' => '0,31 - 0,7', 'nilai' => 2, 'kriteria_id' => Kriteria::find(7)->id],
            ['range' => '0,61 - 1', 'nilai' => 3, 'kriteria_id' => Kriteria::find(7)->id],
            ['range' => '1,1 - 1,5', 'nilai' => 4, 'kriteria_id' => Kriteria::find(7)->id],
            ['range' => '> 1,5', 'nilai' => 5, 'kriteria_id' => Kriteria::find(7)->id],
        ];

        foreach ($data as $item) {
            Subkriteria::create([
                'range' => $item['range'],
                'nilai' => $item['nilai'],
                'kriteria_id' => $item['kriteria_id']
            ]);
        }
    }
}
