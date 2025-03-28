<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });



    // Route::get('/profile', [ProfileController::class, 'index']);
    // Route::apiResource('/profile', ProfileController::class);
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::patch('/{id}', [ProfileController::class, 'update']);
    });
});
