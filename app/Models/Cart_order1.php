<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart_order1 extends Model
{
    use HasFactory;
    protected $table = 'Cart_order1';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id','product_id','price','order_quantity', 'payment_status', 'payment_method','pdf_invoice' 
    ];

}
