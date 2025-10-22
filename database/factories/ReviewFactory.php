<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition()
    {
        return [
            'game_id' => Game::factory(),
            'user_id' => User::factory(),
            'rating' => $this->faker->numberBetween(1, 10),
            'comment' => $this->faker->paragraph(),
        ];
    }
}
