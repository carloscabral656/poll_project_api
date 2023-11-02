<?php

namespace App\Http\Controllers\TypeAvaliations;

use App\DTO\ApiResponse;
use App\helpers\StatusCode;
use App\Http\Controllers\Controller;
use App\Services\TypeAvaliationsService;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;

class TypeAvaliationsController extends Controller
{

    private TypeAvaliationsService $typeAvaliationsService;
    private ApiResponse $apiResponse;

    public function __construct()
    {
        $this->typeAvaliationsService = app(TypeAvaliationsService::class);
        $this->apiResponse  = app(ApiResponse::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $typeAvaliation = $this->typeAvaliationsService->getAll();
        return $this->apiResponse
                    ->setSuccess(false)
                    ->setContent($typeAvaliation)
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
                $this->typeAvaliationsService::getModel()::$createTypeAvaliation
            );
            $data = $request->all();
            $typeAvaliation = $this->typeAvaliationsService->store($data);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($typeAvaliation)
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
        $typeAvaliation = $this->typeAvaliationsService->get($id);
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent($typeAvaliation)
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
                $this->typeAvaliationsService::getModel()::$updateTypeAvaliation
            );
            $data = $request->all();
            $typeAvaliation = $this->typeAvaliationsService->update($data, $id);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($typeAvaliation)
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
        $typeAvaliation = $this->typeAvaliationsService->delete($id);
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent(null)
                    ->setStatusCode(StatusCode::NO_CONTENT)
                    ->create();
    }
}
