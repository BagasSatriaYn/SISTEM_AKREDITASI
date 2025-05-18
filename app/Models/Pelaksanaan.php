<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelaksanaan extends Model
{
    protected $table = 't_pelaksanaan';
    protected $primaryKey = 'id_pelaksanaan';
    protected $fillable = ['id_kriteria', 'deskripsi', 'link', 'pendukung'];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
}   