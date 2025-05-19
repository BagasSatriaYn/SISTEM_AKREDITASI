<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;


class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kriteria::create([
            'nama' => 'Kriteria 1',
        ]);
        
        Kriteria::create([
            'nama' => 'Kriteria 2',
        ]);
        
        Kriteria::create([
            'nama' => 'Kriteria 3',
        ]);
    }
}
