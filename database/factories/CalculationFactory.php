<?php

namespace Database\Factories;

use App\Models\Calculation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calculation>
 */
class CalculationFactory extends Factory
{
    protected $model = Calculation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        return [
            'value1' => $this->faker->randomFloat(2, 0, 1000),
            'value2' => $this->faker->randomFloat(2, 0, 1000),
            'operation' => $this->faker->randomElement(['Add' ,'Subtract', 'Multiply','Divide']),
        ];
    }
}
