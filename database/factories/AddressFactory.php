<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'zip' => $this->faker->numberBetween(0, 99999),
            'state' => $this->faker->state(),
            'country_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
