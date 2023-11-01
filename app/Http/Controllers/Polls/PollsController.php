<?php

namespace App\Http\Controllers;

use App\DTO\ApiResponse;
use App\helpers\StatusCode;
use App\Models\Poll;
use App\Services\PollsService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PollsController extends Controller
{

    private PollsService $pollsService;
    private ApiResponse  $apiResponse;

    public function __construct()
    {
        $this->pollsService = app(PollsService::class);
        $this->apiResponse  = app(ApiResponse::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $polls = $this->pollsService->getAll();
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent($polls)
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
                $this->pollsService::getModel()::$createPollRules
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
    public function show(int $id)
    {
        $poll = $this->pollsService->get($id);
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent($poll)
                    ->setStatusCode(StatusCode::OK)
                    ->create();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try{
            $request->validate(
                $this->pollsService::getModel()::$updatePollRules
            );
            $data = $request->all();
            $poll = $this->pollsService->update($data, $id);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($poll)
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
    public function destroy(int $id)
    {
        $poll = $this->pollsService->delete($id);
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent(null)
                    ->setStatusCode(StatusCode::NO_CONTENT)
                    ->create();
    }
}
