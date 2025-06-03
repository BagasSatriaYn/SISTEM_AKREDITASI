<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finalisasi extends Model
{
    use HasFactory;

    protected $table = 't_finalisasi';
    protected $primaryKey = 'id_finalisasi';

    protected $fillable = [
        'name',
    ];

    public function detailKriterias()
        {
            return $this->hasMany(DetailKriteria::class, 'id_finalisasi', 'id_finalisasi');
        }
    }
