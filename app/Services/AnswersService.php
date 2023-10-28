<?php

namespace App\Services;

use App\Models\Answer;

class AnswersService extends ServiceAbstract
{
    public function __construct(Answer $answer)
    {
        parent::__construct($answer);
    }

    public static function getModel() : Answer {
        return app(Answer::class);
    }
}
