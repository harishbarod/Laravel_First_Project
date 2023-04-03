<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_order extends Model
{
    use HasFactory;
    protected $table = 'cart_order';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id','product_id','price','quantity', 'payment_status' 
    ];

}
