<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Request;

class ProfileController extends Controller
{
    public function index(Request $request): string
    {
        return 'qwe';
    }

    public function show(): string
    {
        return 'qwe';
    }

    public function update(int $id)
    {
        return $id;
    }
}
