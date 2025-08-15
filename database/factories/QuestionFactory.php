<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['rating','comment-only','multiple-choice'];
        return [
            'name' => $this->faker->unique()->sentence(3),
            'question_text' => $this->faker->sentence(12),
            'question_type' => $this->faker->randomElement($types),
        ];
    }
}
