<?php

namespace App\Http\Controllers\Questions\DTO;

use App\interfaces\DTO;
use App\Models\Question;

class QuestionsDTO implements DTO
{ 
    public Question $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function encrypt() : array {
        return [
            'id_poll'         => $this->question->id_poll,
            'statement'       => $this->question->statement,
            'order_question'  => $this->question->order_question,
            'has_comment'     => $this->question->has_comment,
            'status_question' => $this->question->status_question,
            'alternatives'    => $this->question->alternatives
        ];
    }
}
