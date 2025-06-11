<?php

// app/Models/Notification.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel as User;


class Notification extends Model
{
    protected $table = 't_notifications';

    protected $fillable = [
        'user_id', 'from_user_id', 'kriteria_id', 'type', 'title', 'message', 'is_read'
    ];
    public function markAsRead()
{
    $this->is_read = true;
    $this->save();
}

}