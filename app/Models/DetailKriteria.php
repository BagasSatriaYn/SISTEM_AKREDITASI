<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailKriteria extends Model
{
    use HasFactory;

    protected $table = "detail_kriteria";
    protected $primaryKey = "id_detail_kriteria";
    protected $fillable = [
        'id_penetapan',
        'id_pelaksanaan',
        'id_evaluasi',
        'id_pengendalian',
        'id_peningkatan',
        'id_kriteria',
        'id_komentar',
        'id_finalisasi',
        'status'
    ];

    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            'save'    => 'bg-secondary',
            'submit'  => 'bg-primary',
            'revisi'  => 'bg-warning text-dark',
            'acc1'    => 'bg-success',
            'acc2'    => 'bg-info',
            default   => 'bg-secondary'
        };
    }
    public function penetapan(): BelongsTo
    {
        return $this->belongsTo(Penetapan::class, 'id_penetapan', 'id_penetapan');
    }

    public function pelaksanaan(): BelongsTo
    {
        return $this->belongsTo(Pelaksanaan::class, 'id_pelaksanaan', 'id_pelaksanaan');
    }

    public function evaluasi(): BelongsTo
    {
        return $this->belongsTo(Evaluasi::class, 'id_evaluasi', 'id_evaluasi');
    }

    public function pengendalian(): BelongsTo
    {
        return $this->belongsTo(Pengendalian::class, 'id_pengendalian', 'id_pengendalian');
    }

    public function peningkatan(): BelongsTo
    {
        return $this->belongsTo(Peningkatan::class, 'id_peningkatan', 'id_peningkatan');
    }

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria', 'id_kriteria');
    }

    public function komentar()
    {
        return $this->belongsTo(Komentar::class, 'id_komentar');
    }
    // Model Finalisasi
    public function detailKriterias() {
        return $this->hasMany(DetailKriteria::class, 'id_finalisasi', 'id');
    }

    // Model DetailKriteria
    public function finalisasi() {
        return $this->belongsTo(Finalisasi::class, 'id_finalisasi', 'id');
    }

}