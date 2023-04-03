<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription_plans extends Model
{
    use HasFactory;
    protected $table= 'subscription_plans';
    protected $primary_key= 'id';
    protected $fillable = [
        'name', 'price','plan_id','plan_type','admin_id','price_id'
    ];
}
