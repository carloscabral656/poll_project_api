<?php

namespace App\Http\Controllers\Answers\DTO;

use App\interfaces\DTO;
use App\Models\Answer;

class AnswersDTO implements DTO
{
    public Answer $answer;

    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function encrypt() : array {
        return [
            'id_question' => $this->answer->id_question,
            'id_user' => $this->answer->id_user,
            'id_avaliation' => $this->answer->id_avaliation,
            'date_answer' => $this->answer->date_answer,
            'comment' => $this->answer->comment,
        ];
    }
}
