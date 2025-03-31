<?php

namespace App\Models;

use App\Traits\StringTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;
    use StringTraits;

    protected $table = 'movies';
    protected $visible = ['title', 'description', 'release_year', 'image', 'key'];
    protected $fillable = ['title', 'description', 'release_year', 'image', 'key', 'created_by', 'updated_by'];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id')->using(MovieGenre::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Movie $movie) {
            if (in_array('created_by', $movie->getFillable()) && auth()->user()) {
                $movie->created_by = auth()->user()->id;
            }
        });

        static::saving(function (Movie $movie) {
            if ($movie->isDirty(['title', 'release_year'])) {
                // initialize new movie instance to call the getMovieKey method
                $newMovieInstance = new self();

                $movie->key = $newMovieInstance->getMovieKey($movie->title, $movie->release_year);
            }

            if (
                in_array('updated_by', $movie->getFillable()) && auth()->user()) {
                $movie->updated_by = auth()->user()->id;
            }
        });
    }

    public function scopeSelectable(Builder $query): void
    {
        $query->select($this->visible);
    }

    public function scopeLatestByReleaseYear(Builder $query): void
    {
        $query->orderBy('release_year', 'desc');
    }
}
