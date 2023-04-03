<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class One_time_plan extends Model
{
    use HasFactory;
    protected $table = 'one_time_plans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'admin_id','price','duration'
    ];
}
