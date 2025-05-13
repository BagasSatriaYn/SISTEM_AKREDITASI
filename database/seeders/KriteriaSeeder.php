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
            'nama_kriteria' => 'Kriteria 1',
        ]);
        
        Kriteria::create([
            'nama_kriteria' => 'Kriteria 2',
        ]);
        
        Kriteria::create([
            'nama_kriteria' => 'Kriteria 3',
        ]);
    }
}
