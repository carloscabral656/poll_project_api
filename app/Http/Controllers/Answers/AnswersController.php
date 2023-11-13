<?php

namespace App\Http\Controllers\Answers;

use App\DTO\ApiResponse;
use App\helpers\StatusCode;
use App\Http\Controllers\Controller;
use App\Services\AnswersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswersController extends Controller
{

    protected AnswersService $answersService;
    protected ApiResponse $apiResponse;

    public function __construct()
    {
        $this->answersService = app(AnswersService::class);
        $this->apiResponse  = app(ApiResponse::class);
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
                $this->answersService::getModel()::$creat
            );
            $data = $request->all();
            $poll = $this->pollsService->store($data);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($poll)
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
