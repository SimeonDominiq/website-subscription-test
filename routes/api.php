<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\WebsiteController;
use App\Http\Controllers\API\PostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Website routes
Route::prefix('websites')->group(function () {
    Route::post('/', [WebsiteController::class, 'create']);
    Route::post('/{website}/subscribe', [WebsiteController::class, 'subscribe']);
});

// Post routes
Route::prefix('posts')->group(function () {
    Route::post('/{website}', [PostController::class, 'create']);
});
