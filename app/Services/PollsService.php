<?php

namespace App\Services;

use App\Models\Poll;

class PollsService extends ServiceAbstract
{
    public function __construct(Poll $poll)
    {
        parent::__construct($poll);
    }

    public static function getModel() : Poll {
        return app(Poll::class);
    }
}
