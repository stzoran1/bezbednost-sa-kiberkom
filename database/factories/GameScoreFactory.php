<?php

namespace Database\Factories;

use App\Models\GameScore;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GameScore>
 */
class GameScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'player_name' => fake()->firstName(),
            'score' => fake()->numberBetween(0, 10),
            'total_questions' => 10,
            'time_seconds' => fake()->numberBetween(30, 180),
        ];
    }
}
