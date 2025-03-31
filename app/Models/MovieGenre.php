<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MovieGenre extends Pivot
{
    protected $table = 'movie_genre';
    protected $visible = ['movie_id', 'genre_id'];
    protected $fillable = [
        'movie_id',
        'genre_id',
        'created_by'
    ];

    public $timestamps = false;

    protected static function booted(): void
    {
        static::saving(function (MovieGenre $movieGenre) {
            if (in_array('created_by', $movieGenre->getFillable()) && auth()->user()) {
                $movieGenre->created_by = auth()->user()->id;
            }
        });
    }
}
