<?php

namespace App\Http\Controllers\Answers;

use App\DTO\ApiResponse;
use App\helpers\StatusCode;
use App\Http\Controllers\Answers\DTO\AnswersDTO;
use App\Http\Controllers\Controller;
use App\Services\AnswersService;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswersController extends Controller
{

    protected AnswersService $answersService;
    protected ApiResponse $apiResponse;

    public function __construct()
    {
        $this->answersService = app(AnswersService::class);
        $this->apiResponse = app(ApiResponse::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $answers = $this->answersService->getAll();
        return $this->apiResponse
                    ->setSuccess(false)
                    ->setContent($answers)
                    ->setStatusCode(StatusCode::OK)
                    ->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        try{
            $request->validate(
                $this->answersService::getModel()::$createAnswerRules
            );
            $data = $request->all();
            // TODO: We must receive more than one answer.
            $answer = $this->answersService->store($data);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($answer)
                        ->setStatusCode(StatusCode::CREATED)
                        ->create();
        }catch(ValidationException $v){
            return $this->apiResponse
                        ->setSuccess(false)
                        ->setContent($v->getMessage())
                        ->setStatusCode(StatusCode::INTERNAL_SERVER_ERROR)
                        ->create();
        }catch(Exception  $e){
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
        $answer = $this->answersService->get((int) $id);
        $answer = (new AnswersDTO($answer))->encrypt();
        return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($answer)
                        ->setStatusCode(StatusCode::OK)
                        ->create();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //                                      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $answer = $this->answersService->delete((int) $id);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent(null)
                        ->setStatusCode(StatusCode::NO_CONTENT)
                        ->create();
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
