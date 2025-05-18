<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengendalian extends Model
{
    protected $table = 't_pengendalian';
    protected $primaryKey = 'id_pengendalian';
    protected $fillable = ['id_kriteria', 'deskripsi', 'link', 'pendukung'];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
} 