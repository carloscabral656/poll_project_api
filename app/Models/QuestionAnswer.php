<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class QuestionAnswer extends Pivot
{
    protected $table = 'question_answer';
    protected $fillable = [
        'id_answer',
        'id_question'
    ];
}
