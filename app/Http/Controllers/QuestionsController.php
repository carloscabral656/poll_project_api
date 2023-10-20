<?php

namespace App\Http\Controllers;

use App\DTO\ApiResponse;
use App\helpers\StatusCode;
use App\Services\QuestionsService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionsController extends Controller
{

    private QuestionsService $questionService;
    private ApiResponse $apiResponse;

    public function __construct()
    {
        $this->questionService = app(QuestionsService::class);
        $this->apiResponse  = app(ApiResponse::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $question = $this->questionService->getAll();
        return $this->apiResponse
                    ->setSuccess(false)
                    ->setContent($question)
                    ->setStatusCode(StatusCode::OK)
                    ->create();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            $poll = $this->questionService->store($data);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($poll)
                        ->setStatusCode(StatusCode::CREATED)
                        ->create();
        } catch(ValidationException $v) {
            return $this->apiResponse
                        ->setSuccess(false)
                        ->setContent($v->getMessage())
                        ->setStatusCode(StatusCode::OK)
                        ->create();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
