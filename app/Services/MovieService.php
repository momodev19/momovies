<?php

namespace App\Services;

use App\Models\Movie;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;

class MovieService
{
    public function new(StoreMovieRequest $request): Void
    {
        $movie = Movie::create($request->validated());
        $movie->genres()->sync($request->genres);
    }

    public function update(UpdateMovieRequest $request, Movie $movie): void
    {
        $movie->update($request->validated());
        $movie->genres()->sync($request->genres);
    }

    public function get(Movie $movie): array
    {
        return [
            $movie->toArray() + [
                'genres' => $movie->genres->toArray()
            ]
        ];
    }
}
