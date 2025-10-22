<?php

namespace Database\Seeders;

use App\Models\Developer;
use App\Models\Game;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Создаем жанры
        $genres = Genre::factory()->count(10)->create();

        // Создаем разработчиков
        $developers = Developer::factory()->count(5)->create();

        // Создаем пользователей
        $users = User::factory()->count(5)->create();

        // Создаем игры (некоторые удаляем для теста)
        $games = Game::factory()->count(45)->create([
            'developer_id' => fn() => $developers->random()->id,
            'genre_id' => fn() => $genres->random()->id,
        ]);

        // Удаляем некоторые игры
        $games->take(3)->each->delete();

        // Связываем игры с жанрами
        Game::all()->each(function ($game) use ($genres) {
            $game->genres()->attach(
                $genres->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Создаем отзывы
        Review::factory()->count(30)->create([
            'game_id' => fn() => Game::inRandomOrder()->first()->id,
            'user_id' => fn() => $users->random()->id,
        ]);

        User::create([
            'username' => 'Senan',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('123'),
        ]);
    }
}
