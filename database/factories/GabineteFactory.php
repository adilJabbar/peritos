<?php

namespace Database\Factories;

use App\Models\Gabinete;
use Illuminate\Database\Eloquent\Factories\Factory;

class GabineteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'legal_name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'zip' => $this->faker->numberBetween(0, 99999),
            'state' => $this->faker->state(),
            'country_id' => $this->faker->numberBetween(1, 3),
            'legal_id' => $this->faker->uuid(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'www' => $this->faker->url(),
        ];
    }
}
