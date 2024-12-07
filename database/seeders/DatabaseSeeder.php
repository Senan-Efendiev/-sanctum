<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Developer;
use App\Models\Genre;
use App\Models\Game;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создаем несколько жанров
        Genre::factory()->count(10)->create(); // Создает 10 жанров

        // Создаем несколько разработчиков
        $developers = Developer::factory()->count(3)->create();

        // Создаем несколько пользователей
        User::factory()->count(10)->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Создаем несколько игр, связывая их с разработчиками и жанрами
        Game::factory()->count(20)->create([
            'developer_id' => $developers->random()->id,
            'genre_id' => $genres->random()->id,
        ]);
    }
}
