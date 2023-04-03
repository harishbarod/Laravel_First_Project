<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_message extends Model
{
    use HasFactory;
    protected $table = 'chat_messages';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id','sender_id','message' 
    ];
}
