<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 't_notifications';
    protected $primaryKey = 'id_notification';

    protected $fillable = [
        'user_id',
        'from_user_id', 
        'kriteria_id',
        'type',
        'title',
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi ke user penerima
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    // Relasi ke user pengirim
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id_user');
    }

    // Relasi ke kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id', 'id_kriteria');
    }

    // Scope untuk notifikasi yang belum dibaca
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Scope untuk notifikasi user tertentu
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Method untuk menandai sebagai sudah dibaca
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    // Method untuk mendapatkan waktu relatif
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}