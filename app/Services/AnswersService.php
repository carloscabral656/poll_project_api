<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AnswersService extends ServiceAbstract
{

    protected QuestionsService $questionsService;

    /**
     * 
    */
    public function __construct(Answer $answer, QuestionsService $questionsService)
    {
        parent::__construct($answer);
        $this->questionsService = $questionsService;
    }

    /**
     * 
    */
    public static function getModel() : Answer {
        return app(Answer::class);
    }

    /**
     * 
    */
    public function store($data){
        try{
            DB::beginTransaction();
            $answer = $data;
            unset($answer['answers']);
            $answers = $this->getModel()->create($answer);  
            
            // Finding question to sync with answer
            $question = $this->questionsService->get((int) $data['idQuestion']);
            $question->answers->sync($data['idQuestion']);
            DB::commit();
            return $question;
        }catch(QueryException $e){
            DB::rollBack();
            throw $e;
        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
