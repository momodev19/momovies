<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Genre\UpdateGenreRequest;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Genre\StoreGenreRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @unauthenticated
     */
    public function index(): JsonResponse
    {
        return response()->json(
            Genre::selectable()->get()->toArray()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request): JsonResponse
    {
        Genre::create($request->validated());

        return $this->success(['message' => 'Genre created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @unauthenticated
     */
    public function show(Genre $genre): JsonResponse
    {
        return response()->json($genre->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre): JsonResponse
    {
        $genre->update($request->validated());

        return $this->success(['message' => 'Genre updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre): JsonResponse
    {
        $genre->delete();

        return $this->success(['message' => 'Genre deleted successfully']);
    }
}
