<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_model extends Model
{
    use HasFactory;
    protected $table= 'question';
    protected $primary_key= 'id';

    protected $fillable = [
        'question', 'option1', 'option2', 'option3', 'option4', 'ranswer','image'
    ];

}
