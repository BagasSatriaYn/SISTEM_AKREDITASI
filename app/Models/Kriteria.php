<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = "t_kriteria";
    protected $primaryKey = "id_kriteria";
    protected $fillable = ['nama'];

    public function role(): HasMany 
    {
        return $this->hasMany(Level::class);
    }

public function penetapan(): HasMany
{
    return $this->hasMany(Penetapan::class, 'id_kriteria', 'id_kriteria');
}
public function pelaksanaan(): HasMany
{
    return $this->hasMany(Pelaksanaan::class, 'id_kriteria', 'id_kriteria');
}

public function evaluasi(): HasMany
{
    return $this->hasMany(Evaluasi::class, 'id_kriteria', 'id_kriteria');
}

public function peningkatan(): HasMany
{
    return $this->hasMany(Peningkatan::class, 'id_kriteria', 'id_kriteria');
}

public function pengendalian(): HasMany
{
    return $this->hasMany(Pengendalian::class, 'id_kriteria', 'id_kriteria');
}

    public function detail(): HasMany
    {
        return $this->hasMany(DetailKriteria::class);
    }
}