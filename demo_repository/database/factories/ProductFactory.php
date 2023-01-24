<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ["available", "pending", "sold"];
        return [
            'product_name' => $this->faker->name() . 'version_2',
            'status' => $status[array_rand($status)],
        ];
    }
}
