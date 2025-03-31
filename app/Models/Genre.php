<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $table = 'genres';
    protected $visible = ['id', 'title', 'description'];
    protected $fillable = [
        'title',
        'description',
        'created_by',
        'updated_by',
    ];

    protected static function booted(): void
    {
        static::creating(function (Genre $genre) {
            if (in_array('created_by', $genre->getFillable()) && auth()->user()) {
                $genre->created_by = auth()->user()->id;
            }
        });

        static::saving(function (Genre $genre) {
            if (in_array('updated_by', $genre->getFillable()) && auth()->user()) {
                $genre->updated_by = auth()->user()->id;
            }
        });
    }

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'movie_genre', 'genre_id', 'movie_id');
    }

    public function scopeSelectable(Builder $query): void
    {
        $query->select($this->visible);
    }

    public function scopeOrderByTitle(Builder $query): void
    {
        $query->orderBy('title', 'asc');
    }
}
