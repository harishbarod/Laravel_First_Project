<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Right_answer extends Model
{
    use HasFactory;
    protected $table= 'right_answer';
    protected $primary_key= 'id';
    protected $fillable = [
        'question_id', 'user_answer','points','user_id','status_answer'
    ];

}
