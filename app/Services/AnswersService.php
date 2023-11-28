<?php

namespace App\Services;

use App\Models\Answer;
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
            
            // Getting data from JSON request
            $idUser = $data['id_user'];
            $dateAnswer = $data['date_answer'];
            $answers = $data['answers'];
            $insertedAnswers = [];
            // Insert process
            foreach($answers as $answer){
                foreach($answer['choosen_alternatives'] as $alternative){
                    $insetAnswer = [
                        'id_user'       => $idUser, 
                        'id_avaliation' => $alternative,
                        'date_answer'   => $dateAnswer,
                        'comment'       => $answer['comment']
                    ];
                    $insertedAnswers[] = $this->getModel()->create($insetAnswer)->id;    
                }
                // Finding question to sync with answer
                $question = $this->questionsService->get((int) $answer['id_question']);
                $question->answers()->sync($insertedAnswers);
            }

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
