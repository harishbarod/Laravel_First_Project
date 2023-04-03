<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stripe_Customer extends Model
{
    use HasFactory;
    protected $table= 'stripe_customers';
    protected $primary_key= 'id';
    protected $fillable = [
        'user_id', 'customer_id','customer_data'
    ];
}
