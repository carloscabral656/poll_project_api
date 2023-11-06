<?php

namespace App\Http\Controllers\Questions\DTO;

use App\Http\Controllers\Avaliations\DTOs\AvaliationsDTO;
use App\Http\Controllers\TypeAvaliations\DTO\TypeAvaliationDTO;
use App\interfaces\DTO;
use App\Models\Avaliation;
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
            'id'             => $this->question->id,
            'order_question' => $this->question->order_question,
            'statement'      => $this->question->statement,
            'has_comment'    => $this->question->has_comment,
            'alternatives'   => collect($this->question->alternatives->avaliations)
                                ->map(function($a){
                                    return (new AvaliationsDTO($a))->encrypt();
                                })
                               
        ];
    }
}
