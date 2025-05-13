<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_level')->insert([
            [
                'level_kode' => 'A1',
                'level_nama' => 'Anggota 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'A2',
                'level_nama' => 'Anggota 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'A3',
                'level_nama' => 'Anggota 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'A4',
                'level_nama' => 'Anggota 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'A5',
                'level_nama' => 'Anggota 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'A6',
                'level_nama' => 'Anggota 6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'A7',
                'level_nama' => 'Anggota 7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'A8',
                'level_nama' => 'Anggota 8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'A9',
                'level_nama' => 'Anggota 9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'KJR',
                'level_nama' => 'Kajur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'SPI',
                'level_nama' => 'Satuan Pengawas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level_kode' => 'DKT',
                'level_nama' => 'Direktur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}