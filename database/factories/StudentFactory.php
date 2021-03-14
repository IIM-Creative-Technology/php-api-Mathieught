<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lastname' => $this->faker->lastName,
            'firstname' => $this->faker->firstName,
            'age' => $this->faker->numberBetween(18, 30),
            'year_start' => $this->faker->numberBetween(2019, 2024),
            'classroom_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
