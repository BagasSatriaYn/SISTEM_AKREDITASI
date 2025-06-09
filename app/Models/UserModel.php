<?php

namespace App\Models;
 
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Relations\BelongsTo;
 use Illuminate\Foundation\Auth\User as Authenticatable;

 class UserModel extends Authenticatable 
 {
     use HasFactory;
 
     protected $table = 'm_user';
     protected $primaryKey = 'id_user';
     protected $fillable = ['id_level', 'username', 'name', 'password', 'created_at', 'updated_at'];
 
     protected $hidden = ['password'];
     protected $casts = ['password' => 'hashed'];
    
     public function level(): BelongsTo 
     {
         return $this->belongsTo(Level::class, 'id_level', 'id_level');
     }
 
     public function getRoleName(): string
     {
         return $this->level->level_nama;
     }
 
     public function hasRole($role): bool
     {
         return $this->level->level_kode == $role;
     }
       public function getRole() 
     {
         return $this->level->level_kode;
     }

       // Accessor untuk mendapatkan inisial nama
    public function getInitialsAttribute()
    {
        $names = explode(' ', $this->name);
        $initials = '';
        
        foreach ($names as $name) {
            $initials .= strtoupper(substr($name, 0, 1));
        }
        
        return $initials;
    }

    // Accessor untuk mendapatkan role name
    public function getRoleNameAttribute()
    {
        // Mapping level ID ke nama role
        $roles = [
            1 => 'Super Admin',
            2 => 'Administrator',
            3 => 'Manager',
            4 => 'User'
        ];
        
        return $roles[$this->id_level] ?? 'User';
    }
}
