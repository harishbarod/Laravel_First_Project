<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions_taken extends Model
{
    use HasFactory;
    protected $table= 'subscription_taken';
    protected $primary_key= 'id';
    protected $fillable = [
        'id', 'subscription_id','product_id','data','subscription_item_id','customer_id','price_id','user_id'
    ];
}
