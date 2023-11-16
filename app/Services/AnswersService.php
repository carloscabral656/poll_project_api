<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionAnswer;
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
            DB::beginTransaction();
            
            // Insert process
            $answers = [];
            foreach($data['answers'] as $answer){
                $answer = [
                    'id_user'       => 1, //TODO: Create user after this
                    'id_avaliation' => $answer,
                    'date_answer'   => $data['dateAnswer'],
                    'comment'       => $data['comment']
                ];
                $answers[] = $this->getModel()->create($answer)->id; 
            }

            // Finding question to sync with answer
            $question = $this->questionsService->get((int) $data['idQuestion']);
            $question->answers()->sync($answers);

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

    /**
     * Override delete
    */
    public function delete(int $idAnswer)
    {
        try{
            DB::beginTransaction();
            $answer = $this->get($idAnswer);
            $question = $answer->question()->first();
            $question->answers()->detach($idAnswer);
            $answer->delete();
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
