<?php

namespace App\Services;

use App\Models\Question;

class QuestionsService extends ServiceAbstract
{
    public function __construct(Question $question)
    {
        parent::__construct($question);
    }

    public static function getModel() : Question {
        return app(Question::class);
    }
}
