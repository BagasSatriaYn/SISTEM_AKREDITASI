<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 't_komentar'; // nama tabel sesuai DB
    protected $primaryKey = 'id_komentar'; // sesuai struktur

   protected $fillable = [
    'id_kriteria',
    'komen',
    'oleh'
];
}
