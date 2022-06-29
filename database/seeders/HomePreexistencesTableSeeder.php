<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePreexistencesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('home_preexistences')->delete();

        DB::table('home_preexistences')->insert([
            0 => [
                'id' => 1,
                'riskdetail_id' => 2,
                'dimension' => 150,
                'year' => 2005,
                'owner' => 'asegurado',
                'user' => 'asegurado',
                'used_as' => 'habitual',
                'structure' => 'hormigon',
                'roof' => 'teja',
                'wall' => 'ladrillo',
                'rooms' => 3,
                'quality' => 'media',
                'quality_perc' => '1.00',
                'maintenance' => '1.00',
                'people' => 4,
                'furniture' => 'media',
                'furniture_perc' => '1.00',
                'amount' => 'normal',
                'amount_perc' => '1.00',
                'pets' => 0,
                'created_at' => '2021-11-11 18:09:37',
                'updated_at' => '2021-11-11 18:12:53',
            ],
        ]);
    }
}
