<?php

namespace Database\Factories;

use App\Traits\StringTraits;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    use StringTraits;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = rtrim($this->faker->sentence(3), '.');
        $releaseYear = $this->faker->year();

        return [
            'title' => $title,
            'description' => $this->faker->paragraph(),
            'release_year' => $releaseYear,
            'image' => 'https://picsum.photos/200/300?random=' . Str::random(10),
            'key' => $this->getMovieKey($title, $releaseYear),
        ];
    }
}
