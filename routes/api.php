<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\APIUserController;
use App\Http\Controllers\API\APICategoryController;
use App\Http\Controllers\API\APIPortofolioController;
use App\Http\Controllers\API\APISosmedController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('users', [\App\Http\Controllers\API\AuthController::class, 'index']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function () {
    // Avatar Profile Route
    Route::post('user/profile', [APIUserController::class, 'uploadAvatar']);
    // About Me
    Route::post('user/about', [APIUserController::class, 'aboutUser']);
    // Category
    Route::post('category', [APICategoryController::class, 'store']);
    // Sosmed
    Route::post('sosmed', [APISosmedController::class, 'store']);
    // Portofolio
    Route::post('portofolio', [APIPortofolioController::class, 'store']);
    Route::post('portofolio/image', [APIPortofolioController::class, 'storeImage']);
});
