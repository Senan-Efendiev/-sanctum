<?php

namespace Database\Factories;

use App\Models\Developer;
use App\Models\Game;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'release_date' => $this->faker->date(),
            'developer_id' => Developer::factory(),
            'genre_id' => Genre::factory(),
            'platform' => $this->faker->randomElement(['PC', 'PS5', 'Xbox', 'Switch']),
        ];
    }
}
