<?php

namespace App\Http\Controllers\Questions;

use App\DTO\ApiResponse;
use App\helpers\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Questions\DTO\QuestionsDTO;
use App\Services\QuestionsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionsController extends Controller
{

    private QuestionsService $questionService;
    private ApiResponse $apiResponse;

    public function __construct()
    {
        $this->questionService = app(QuestionsService::class);
        $this->apiResponse     = app(ApiResponse::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = $this->questionService->getAll();
        $questions = collect($questions)->map(function($q){
            return (new QuestionsDTO($q))->encrypt();
        });
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent($questions)
                    ->setStatusCode(StatusCode::OK)
                    ->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate(
                $this->questionService::getModel()::$createQuestionRules
            );
            $data = $request->all();
            $question = $this->questionService->store($data);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($question)
                        ->setStatusCode(StatusCode::CREATED)
                        ->create();
        }catch(ValidationException $v){
            return $this->apiResponse
                        ->setSuccess(false)
                        ->setContent($v->getMessage())
                        ->setStatusCode(StatusCode::INTERNAL_SERVER_ERROR)
                        ->create();
        }catch(Exception $e){
            return $this->apiResponse
                        ->setSuccess(false)
                        ->setContent($e->getMessage())
                        ->setStatusCode(StatusCode::INTERNAL_SERVER_ERROR)
                        ->create();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = $this->questionService->get($id);
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent($question)
                    ->setStatusCode(StatusCode::OK)
                    ->create();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate(
                $this->questionService::getModel()::$updateQuestionRules
            );
            $data = $request->all();
            $question = $this->questionService->update($data, $id);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($question)
                        ->setStatusCode(StatusCode::OK)
                        ->create();
        } catch(ValidationException $v) {
            return $this->apiResponse
                        ->setSuccess(false)
                        ->setContent($v->getMessage())
                        ->setStatusCode(StatusCode::INTERNAL_SERVER_ERROR)
                        ->create();
        }catch(Exception $e){
            return $this->apiResponse
                        ->setSuccess(false)
                        ->setContent($e->getMessage())
                        ->setStatusCode(StatusCode::INTERNAL_SERVER_ERROR)
                        ->create();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $questions = $this->questionService->delete($id);
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent(null)
                    ->setStatusCode(StatusCode::NO_CONTENT)
                    ->create();
    }
}
