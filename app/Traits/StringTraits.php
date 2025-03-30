<?php

namespace App\Traits;

trait StringTraits
{
    public function getMovieKey(string $title, int $year): string
    {
        $key = str_replace(' ', '-', $title . ' ' . $year); // Replaces all spaces with hyphens.
        $key = preg_replace('/[^A-Za-z0-9\-]/', '', $key); // Removes special chars.
        return preg_replace('/-+/', '-', $key); // Replaces multiple hyphens with single one.
    }
}
