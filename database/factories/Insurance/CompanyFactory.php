<?php

namespace Database\Factories\Insurance;

use App\Models\Insurance\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

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
            'legal_id' => $this->faker->uuid(),
            'url' => $this->faker->url(),
        ];
    }
}
