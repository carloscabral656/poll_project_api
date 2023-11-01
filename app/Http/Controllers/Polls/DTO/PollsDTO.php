<?php

namespace App\Http\Controllers\Polls\DTO;

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
            'title' => $this->poll->title,
            'description' => $this->poll->description,
            'begin_at' => $this->poll->begin_at,
            'finish_at' => $this->poll->finish_at
        ];
    }
}
