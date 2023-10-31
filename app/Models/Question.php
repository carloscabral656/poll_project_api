<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public $table = 'questions';
    public $with = ['alternatives'];
    public $fillable = [
        'id_poll',
        'id_type_avaliation',
        'statement',
        'order_question',
        'has_comment',
        'status_question'
    ];
    public static $createQuestionRules = [
        'id_poll'            => 'required',
        'id_type_avaliation' => 'required',
        'statement'          => 'required',
        'order_question'     => 'required',
        'has_comment'        => 'required',
        'status_question'    => 'required'
    ];
    public static $updateQuestionRules = [
        'id_poll'            => 'required',
        'id_type_avaliation' => 'required',
        'statement'          => 'required',
        'order_question'     => 'required',
        'has_comment'        => 'required',
        'status_question'    => 'required'
    ];
    public function alternatives(){
        return $this->hasOne(
            TypeAvaliation::class,
            'id',
            'id_type_avaliation'
        );
    }
    public function answers(){
        return $this->hasManyThrough(
            Answer::class,
            'question_answer',
            'id_answer',
            'id_question'
        );
    }
}
