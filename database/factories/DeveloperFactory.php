<?php

namespace Database\Factories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    protected $model = Developer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'founded' => $this->faker->date(),
        ];
    }
}
