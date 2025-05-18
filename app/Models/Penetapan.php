<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penetapan extends Model
{
    protected $table = 't_penetapan';
    protected $primaryKey = 'id_penetapan';
    protected $fillable = ['id_kriteria', 'deskripsi', 'link', 'pendukung'];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
} 