<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

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

Route::post('/login', [AuthController::class, 'store'])->name('login');

Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return \App\Models\User::all();
});

Route::controller(PostController::class)->prefix('posts')->name('posts.')->group(function () {
    Route::get('/', 'index');
    Route::get('/{post}', 'show');

    // Route::middleware('auth:sanctum')->group(function () {
        Route::post('/{post}', 'store');
        Route::put('/{post}', 'update');
        Route::delete('/{post}', 'destroy');
    // });
});

// Route::resource('photos.comments', CommentController::class)->shallow();

