<?php

namespace Database\Factories;

use App\Models\Mark;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mark::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mark' => $this->faker->numberBetween(0, 20),
            'student_id' => $this->faker->numberBetween(1, 8),
            'course_id' => $this->faker->numberBetween(1, 8)
        ];
    }
}
