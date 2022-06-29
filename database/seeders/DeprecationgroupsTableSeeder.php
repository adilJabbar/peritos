<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeprecationgroupsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('deprecationgroups')->delete();

        DB::table('deprecationgroups')->insert([
            0 => [
                'id' => 1,
                'country_id' => 1,
                'name' => 'Construcción',
                'estimated_years' => '100.00',
                'residual_percent' => '30.00',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-11-11 14:58:41',
            ],
            1 => [
                'id' => 2,
                'country_id' => 1,
                'name' => 'Mobiliario',
                'estimated_years' => '10.00',
                'residual_percent' => '20.00',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-11-11 14:58:41',
            ],
            2 => [
                'id' => 3,
                'country_id' => 1,
                'name' => 'Electrónica',
                'estimated_years' => '5.00',
                'residual_percent' => '20.00',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-11-11 14:58:41',
            ],
        ]);
    }
}
