<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        $category_id = Category::all()->random()->id;

        return [
            'name' => $faker->name,
            'description' => $faker->paragraph,
            'category_id' => $category_id,
            'author' => $faker->name,
            'price' => $faker->numberBetween($min=10, $max=5000)
        ];
    }
}
