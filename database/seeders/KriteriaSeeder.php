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
            ['name' => 'npm', 'kode_database' => '1', 'description' => 'net profit margin', 'type' => 'benefit', 'bobot' => 3],
            ['name' => 'roa', 'kode_database' => '2', 'description' => 'return of assets', 'type' => 'benefit', 'bobot' => 9],
            ['name' => 'roe', 'kode_database' => '3', 'description' => 'return of equity', 'type' => 'benefit', 'bobot' => 9],
            ['name' => 'eps', 'kode_database' => '4', 'description' => 'earning per share', 'type' => 'benefit', 'bobot' => 3],
            ['name' => 'per', 'kode_database' => '5', 'description' => 'price earning ration', 'type' => 'cost', 'bobot' => 3],
            ['name' => 'der', 'kode_database' => '6', 'description' => 'debt to equity ration', 'type' => 'cost', 'bobot' => 6],
            ['name' => 'pbv', 'kode_database' => '7', 'description' => 'price to book value', 'type' => 'cost', 'bobot' => 6],
        ];

        foreach ($data as $key=>$item) {
            Kriteria::create([
                'code' => $key + 1,
                'name' => $item['name'],
                'kode_database' => $item['kode_database'],
                'description' => $item['description'],
                'type' => $item['type'],
                'bobot' => $item['bobot'],
            ]);
        }
    }
}
