<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
           [
                'id_user' => 1,
                'id_level' => 1,
                'username' => 'Satria',
                'name' => 'Bagas Satria',
                'password' => Hash::make('12345'), // class untuk mengenkripsi/hash password
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_user' => 2,
                'id_level' => 2,
                'username' => 'aqueena',
                'name' => 'Aqueena Regita',
                'password' => Hash::make('12345'), // class untuk mengenkripsi/hash password
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_user' => 3,
                'id_level' => 3,
                'username' => 'babby',
                'name' => 'My Babby F',
                'password' => Hash::make('12345'), // class untuk mengenkripsi/hash password
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_user' => 4,
                'id_level' => 4,
                'username' => 'veve',
                'name' => 'Lovelyta Sekarayu',
                'password' => Hash::make('12345'), // class untuk mengenkripsi/hash password
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_user' => 5,
                'id_level' => 5,
                'username' => 'adyuta',
                'name' => 'Adyuta Raksa',
                'password' => Hash::make('12345'), // class untuk mengenkripsi/hash password
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_user' => 6,
                'id_level' => 6,
                'username' => 'Joko',
                'name' => 'Joko Prasetyo',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_user' => 7,
                'id_level' => 7,
                'username' => 'devina',
                'name' => 'Devina Karamoy',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

             [
                'id_user' => 8,
                'id_level' => 8,
                'username' => 'bryan',
                'name' => 'Bryan Hartono',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

             [
                'id_user' => 9,
                'id_level' => 9,
                'username' => 'jack',
                'name' => 'Jack Reaper',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

             [
                'id_user' => 10,
                'id_level' => 10,
                'username' => 'kajur',
                'name' => 'Kepala Jurusan',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

             [
                'id_user' => 11,
                'id_level' => 11,
                'username' => 'spi',
                'name' => 'Satuan Pengawas Internal',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],

             [
                'id_user' => 12,
                'id_level' => 12,
                'username' => 'dir',
                'name' => 'Direktur',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('m_user')->insert($data);
    }
}