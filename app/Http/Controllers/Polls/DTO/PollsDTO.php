<?php

namespace App\Http\Controllers\Polls\DTO;

use App\Http\Controllers\Questions\DTO\QuestionsDTO;
use App\Http\Controllers\TypeAvaliations\DTO\TypeAvaliationDTO;
use App\interfaces\DTO;
use App\Models\Poll;

class PollsDTO implements DTO
{
    public Poll $poll;

    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
    }

    public function encrypt() : array {
        return [
            'id'          => $this->poll->id,
            'title'       => $this->poll->title,
            'description' => $this->poll->description,
            'begin_at'    => $this->poll->begin_at,
            'finish_at'   => $this->poll->finish_at,
            'questions'   => collect($this->poll->questions)
                            ->map(function($q){
                                return (new QuestionsDTO($q))->encrypt(); 
                            })
        ];
    }
}
