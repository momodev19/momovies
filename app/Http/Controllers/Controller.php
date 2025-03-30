<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected function success(array $data = []): JsonResponse
    {
        return response()->json($data + [
            'success' => true
        ]);
    }
}
