<?php

namespace App\Models;

use App\Traits\StringTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory;
    use StringTraits;

    protected $table = 'movies';

    protected $fillable = ['title', 'description', 'release_year', 'image', 'key'];

    protected static function booted(): void
    {
        // initialize new movie instance to call the getMovieKey method
        $newMovieInstance = new self();

        static::creating(function (Movie $movie) use ($newMovieInstance) {
            $movie->key = $newMovieInstance->getMovieKey($movie->title, $movie->release_year);
        });

        static::updating(function (Movie $movie) use ($newMovieInstance) {
            $movie->key = $newMovieInstance->getMovieKey($movie->title, $movie->release_year);
        });
    }

    public function scopeSelectable(Builder $query): void
    {
        $query->select($this->fillable);
    }

    public function scopeLatestByReleaseYear(Builder $query): void
    {
        $query->orderBy('release_year', 'desc');
    }
}
