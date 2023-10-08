<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $table = 'questions';
    public $fillable = [
        'id_poll',
        'id_type_avaliation',
        'statement',
        'order_question',
        'has_comment',
        'status_question'
    ];

    public function alternatives(){
        return $this->hasMany(
            Question::class,
            'id_poll',
            'id'
        );
    }
}
