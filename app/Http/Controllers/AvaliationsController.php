<?php

namespace App\Http\Controllers;

use App\DTO\ApiResponse;
use App\helpers\StatusCode;
use App\Services\AvaliationsService;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AvaliationsController extends Controller
{

    private AvaliationsService $avaliationsService;
    private ApiResponse $apiResponse;

    public function __construct()
    {
        $this->avaliationsService = app(AvaliationsService::class);
        $this->apiResponse  = app(ApiResponse::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $avaliations = $this->avaliationsService->getAll();
        return $this->apiResponse
                    ->setSuccess(false)
                    ->setContent($avaliations)
                    ->setStatusCode(StatusCode::OK)
                    ->create();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate(
                $this->avaliationsService::getModel()::$createAvaliationRules
            );
            $data = $request->all();
            $avaliation = $this->avaliationsService->store($data);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($avaliation)
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
        $avaliation = $this->avaliationsService->get($id);
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent($avaliation)
                    ->setStatusCode(StatusCode::OK)
                    ->create();
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
        try{
            $request->validate(
                $this->avaliationsService::getModel()::$updateAvaliationRules
            );
            $data = $request->all();
            $poll = $this->avaliationsService->update($data, $id);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($poll)
                        ->setStatusCode(StatusCode::OK)
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $avaliation = $this->avaliationsService->delete($id);
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent(null)
                    ->setStatusCode(StatusCode::NO_CONTENT)
                    ->create();
    }
}
