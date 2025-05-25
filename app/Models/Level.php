<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'm_level';
    
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_level';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'level_kode',
        'level_nama',
    ];
    
    /**
     * Get the relationships that may be using this level.
     * 
     * Note: Update this method with your actual relationships
     */
    // Example relationship method
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'level_id', 'level_id');
    // }
}       