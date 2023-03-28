<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name'=>fake()->name,
            'price'=>fake()->numberBetween(10000,100000),
            'date'=>fake()->dateTime(),
            'status'=>fake()->boolean,
            'category_id'=>fake()->numberBetween(1,10)
        ];
    }
}
