<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Seed the genre table
     */
    public function run(): void
    {
        $genres = [
            [
                'title' => 'Action',
                'description' => 'Fast-paced films that often feature high-energy action sequences, thrilling stunts, and heroic protagonists.',
            ],
            [
                'title' => 'Comedy',
                'description' => 'Light-hearted films that aim to entertain and amuse, often using humor, satire, or irony to tell a story.',
            ],
            [
                'title' => 'Drama',
                'description' => 'Serious films that focus on character development and emotional depth, often exploring complex themes and issues.',
            ],
            [
                'title' => 'Horror',
                'description' => 'Films that aim to scare, unsettle, or disturb the audience, often using supernatural or terrifying elements.',
            ],
            [
                'title' => 'Romance',
                'description' => 'Films that focus on the emotional journey of the characters, often exploring themes of love, relationships, and emotional connection.',
            ],
            [
                'title' => 'Thriller',
                'description' => 'Suspenseful films that often feature twists and turns, keeping the audience on the edge of their seats as they try to piece together the mystery.',
            ],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
