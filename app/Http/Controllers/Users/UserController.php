<?php

namespace App\Http\Controllers\Users;

use App\DTO\ApiResponse;
use App\helpers\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users\DTO\UsersDTO;
use App\Services\UsersService;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private UsersService $userService;
    private ApiResponse $apiResponse;

    public function __construct()
    {
        $this->userService = app(UsersService::class);
        $this->apiResponse = app(ApiResponse::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $users = $this->userService->getAll();
        $questions = collect($users)->map(function($q){
            return (new UsersDTO($q))->encrypt();
        });
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent($questions)
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
                $this->userService::getModel()::$createUserRules
            );
            $data = $request->all();
            $user = $this->userService->store($data);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($user)
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
        $user = $this->userService->get($id);
        if(!is_null($user))
            $user = (new UsersDTO($user))->encrypt();
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent($user)
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
                $this->userService::getModel()::$updateUserRules
            );
            $data = $request->all();
            $user = $this->userService->update($data, $id);
            return $this->apiResponse
                        ->setSuccess(true)
                        ->setContent($user)
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
        $user = $this->userService->delete($id);
        return $this->apiResponse
                    ->setSuccess(true)
                    ->setContent(null)
                    ->setStatusCode(StatusCode::NO_CONTENT)
                    ->create();
    }
}
