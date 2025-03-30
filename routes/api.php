<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\MovieController;
use App\Http\Controllers\Api\V1\ProfileController;

// Route::get('/user', function (Request $request) {
//     dd('qwe');
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/user', function (Request $request) {
//     // dd('qwe');
//     dd(
//         $request->user()
//     );
//     return $request->user();
// });

// auth route
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'movie'], function () {
    Route::get('/', [MovieController::class, 'index']);
    Route::get('/{movie:key}', [MovieController::class, 'show']);
});

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::patch('/{id}', [ProfileController::class, 'update']);
    });

    Route::group(['prefix' => 'movie'], function () {
        Route::post('/', [MovieController::class, 'store']);
        Route::patch('/{movie:key}', [MovieController::class, 'update']);
    });
});
