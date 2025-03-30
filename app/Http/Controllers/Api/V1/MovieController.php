<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Movie;
use Illuminate\Support\Arr;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MovieController extends Controller
{
    /**
     * Fetch all movies in paginated form.
     *
     * @unauthenticated
     */
    public function index(): JsonResponse
    {
        return response()->json(
            Movie::selectable()
                ->latestByReleaseYear()
                ->paginate(5)
                ->toArray()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request, MovieService $movieService)
    {
        $movieService->new($request->validated());

        return response()->json(['success' => true]);
    }

    /**
     * Fetch the specified movie.
     *
     * @unauthenticated
     *
     * @throws NotFoundHttpException
     */
    public function show(Movie $movie): JsonResponse
    {
        return response()->json(Arr::only($movie->getAttributes(), $movie->getFillable()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie, MovieService $movieService)
    {
        $movieService->update($request->validated(), $movie);

        $movie->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
