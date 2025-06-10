<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_level')->updateOrInsert(
            ['id_level' => 13],
            ['level_kode' => 'SUPER', 'level_nama' => 'Super Admin', 'created_at' => now(), 'updated_at' => now()]
        );
        $data = [
            [
                'id_user' => 13,
                'id_level' => 13,
                'username' => 'superadmin',
                'name' => 'Super Admin',
                'password' => Hash::make('12345'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('m_user')->insert($data);
    }
}
