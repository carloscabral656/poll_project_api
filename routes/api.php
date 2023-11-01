<?php

use App\Http\Controllers\Answers\AnswersController;
use App\Http\Controllers\AvaliationsController;
use App\Http\Controllers\PollsController;
use App\Http\Controllers\Questions\QuestionsController;
use App\Http\Controllers\TypeAvaliationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/v1')->group(function(){
    Route::resource('/polls'      , PollsController::class);
    Route::resource('/questions'  , QuestionsController::class);
    Route::resource('/type-avaliation', TypeAvaliationsController::class);
    Route::resource('/avaliations', AvaliationsController::class);
    Route::resource('/answers'    , AnswersController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
