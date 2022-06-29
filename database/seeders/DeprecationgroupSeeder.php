<?php

namespace Database\Seeders;

use App\Models\Admin\Deprecationgroup;
use Illuminate\Database\Seeder;

class DeprecationgroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deprecationgroup::truncate();

        Deprecationgroup::create([
            'country_id' => 1,
            'name' => 'Construcción',
            'estimated_years' => 100,
            'residual_percent' => 30,
        ]);

        Deprecationgroup::create([
            'country_id' => 1,
            'name' => 'Mobiliario',
            'estimated_years' => 10,
            'residual_percent' => 20,
        ]);

        Deprecationgroup::create([
            'country_id' => 1,
            'name' => 'Electrónica',
            'estimated_years' => 5,
            'residual_percent' => 20,
        ]);
    }
}
