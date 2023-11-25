<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    /**
     * 
    */
    public $table = 'answers';

    /**
     * 
    */
    public $fillable = [
        'id_user',
        'id_avaliation',
        'date_answer',
        'comment'
    ];

    /**
     * 
    */
    public static $createAnswerRules = [
        'id_question'   => 'required',
        'id_user'       => 'required',
        'answers'       => 'required',
        'date_answer'   => 'required'
    ];

    /**
     * 
    */
    public static $updateAnswerRules = [
        'id_question'   => 'required',
        'id_user'       => 'required',
        'id_avaliation' => 'required',
        'date_answer'   => 'required',
        'comment'       => 'required'
    ];

    /**
     * 
    */
    public function question() {
        return $this->belongsToMany(
           Question::class,
           QuestionAnswer::class ,
           'id_answer',
           'id_question'
        );
    }
}
