<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'rata-rata kabupaten 2017', 'kode_database' => 'avg_kab_2017', 'type' => 'benefit', 'bobot' => 4],
            ['name' => 'rata-rata kabupaten 2018', 'kode_database' => 'avg_kab_2017', 'type' => 'benefit', 'bobot' => 4],
            ['name' => 'rata-rata kabupaten 2019', 'kode_database' => 'avg_kab_2017', 'type' => 'benefit', 'bobot' => 4],
        ];

        foreach ($data as $key=>$item) {
            Kriteria::create([
                'code' => $key + 1,
                'name' => $item['name'],
                'kode_database' => $item['kode_database'],
                // 'description' => $item['description'],
                'type' => $item['type'],
                'bobot' => $item['bobot'],
            ]);
        }
    }
}
