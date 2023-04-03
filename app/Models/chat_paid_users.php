<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat_paid_users extends Model
{
    use HasFactory;
    protected $table = 'chat_paid_users';
    protected $fillable = [
        'user_id',
        'payment_status',
        'payment_method',
        'price',
        'pdf_invoice',
        'start_date',
        'expire_date',
    ];
}
