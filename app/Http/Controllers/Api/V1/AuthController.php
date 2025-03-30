<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Login to get token
     *
     * @unauthenticated
     */
    public function login(Request $request, LoginRequest $loginRequest): JsonResponse
    {
        $loginRequest->authenticate();

        return response()->json([
            'token' => $request->user()->createToken($request->email)->plainTextToken,
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }
}
