<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peningkatan extends Model
{
    protected $table = 't_peningkatan';
    protected $primaryKey = 'id_peningkatan';
    protected $fillable = ['id_kriteria', 'deskripsi', 'link', 'pendukung'];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
} 