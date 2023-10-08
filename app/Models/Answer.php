<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public $table = 'answers';
    public $fillable = [
        'id_question',
        'id_user',
        'id_avaliation',
        'date_answer',
        'comment'
    ];
}
