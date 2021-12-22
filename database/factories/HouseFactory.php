<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(100000),
            'Bedrooms' => $this->faker->numberBetween(0, 6),
            'Bathrooms' => $this->faker->numberBetween(0, 6),
            'Storeys' => $this->faker->numberBetween(0, 6),
            'Garages' => $this->faker->numberBetween(0, 6),
        ];
    }
}
