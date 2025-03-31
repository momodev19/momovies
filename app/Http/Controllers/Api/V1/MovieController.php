<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Movie;
use DB;
use App\Services\MovieService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\StoreMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MovieController extends Controller
{
    public function __construct(public MovieService $movieService)
    {
    }

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
    public function store(StoreMovieRequest $request)
    {
        DB::transaction(function () use ($request) {
            $this->movieService->new($request);
        });

        return $this->success(['message' => 'Movie created successfully']);
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
        return response()->json($this->movieService->get($movie));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        DB::transaction(function () use ($request, $movie) {
            $this->movieService->update($request, $movie);
        });

        return $this->success(['message' => 'Movie updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return $this->success(['message' => 'Movie deleted successfully']);
    }
}
