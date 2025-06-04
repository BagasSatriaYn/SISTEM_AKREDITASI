<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_kriteria' => 1, 'nama' => 'VISI, MISI, TUJUAN DAN STRATEGI'],
            ['id_kriteria' => 2, 'nama' => 'TATA KELOLA, TATA PAMONG, DAN KERJASAMA'],
            ['id_kriteria' => 3, 'nama' => 'MAHASISWA'],
            ['id_kriteria' => 4, 'nama' => 'SUMBER DAYA MANUSIA'],
            ['id_kriteria' => 5, 'nama' => 'KEUANGAN, SARANA, DAN PRASARANA'],
            ['id_kriteria' => 6, 'nama' => 'PENDIDIKAN'],
            ['id_kriteria' => 7, 'nama' => 'PENELITIAN'],
            ['id_kriteria' => 8, 'nama' => 'PENGABDIAN KEPADA MASYARAKAT'],
            ['id_kriteria' => 9, 'nama' => 'LUARAN DAN CAPAIAN TRIDARMA'],
        ];

        foreach ($data as $kriteria) {
            DB::table('t_kriteria')->updateOrInsert(
                ['id_kriteria' => $kriteria['id_kriteria']],
                ['nama' => $kriteria['nama'], 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
