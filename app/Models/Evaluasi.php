<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $table = 't_evaluasi';
    protected $primaryKey = 'id_evaluasi';
    protected $fillable = ['id_kriteria', 'deskripsi', 'link', 'pendukung'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
}                                                                                                   