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

        $value1 = $this->faker->randomFloat(2, 0, 1000);
        $value2 = $this->faker->randomFloat(2, 0, 1000);
        $calculated_percentage = ($value1 * $value2) / 100;

        return [
            'value1' => $value1,
            'value2' => $value2,
            'calculated_percentage' => $calculated_percentage
        ];
    }
}
