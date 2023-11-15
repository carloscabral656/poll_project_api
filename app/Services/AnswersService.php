<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use DateTime;
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

            //return (new DateTime());

            DB::beginTransaction();
            
            // Insert process
            $answers = [];
            foreach($data['answers'] as $answer){
                $answer = [
                    'id_user'       => 1, //TODO:Create user after this
                    'id_avaliation' => $answer,
                    'date_answer'   => $data['dateAnswer'],
                    'comment'       => $data['comment']
                ];
                $answers[] = $this->getModel()->create($answer); 
            }

            // 
            return $answers;
            
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
