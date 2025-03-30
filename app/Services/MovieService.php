<?php

namespace App\Services;

use App\Models\Movie;
use App\Traits\StringTraits;

class MovieService
{
    use StringTraits;

    public function new(array $data): void
    {
        Movie::create($data);
    }

    public function update(array $data, Movie $movie): void
    {
        $movie->fill($data);
    }
}
