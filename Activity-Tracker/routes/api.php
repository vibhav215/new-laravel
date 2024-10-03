<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamManageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);


Route::get('/ajax/project_listing/{id}', [TeamManageController::class, 'ajaxProjectListing']);
Route::get('/ajax/project_listing/edit/{id}', [TeamManageController::class, 'ajaxProjectListingEdit']);
Route::get('/ajax/project_listing/edit/{id}', [TeamManageController::class, 'ajaxProjectListingEdit']);

Route::post('/task-handler', [TaskController::class, 'ajaxTaskHandler']);
Route::post('/task-vedio-uploader', [TaskController::class, 'ajaxTaskVedioHandler']);