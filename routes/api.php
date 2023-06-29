<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
Route::get('/users/{user}/posts', [UserController::class, 'posts'])->middleware('auth:sanctum');

Route::controller(PostController::class)->prefix('posts')->name('posts.')->group(function () {
    Route::get('/', 'index');
    Route::get('/{post}', 'show');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', 'store');
        Route::put('/{post}', 'update');
        Route::patch('/{post}', 'update');
        Route::delete('/{post}', 'destroy');
    });
});