<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiskgroupsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('riskgroups')->delete();

        DB::table('riskgroups')->insert([
            0 => [
                'id' => 1,
                'country_id' => 1,
                'name' => 'No residencial',
                'created_at' => '2021-03-23 15:01:12',
                'updated_at' => '2021-03-23 15:01:12',
            ],
            1 => [
                'id' => 2,
                'country_id' => 1,
                'name' => 'Residencial',
                'created_at' => '2021-11-22 08:20:39',
                'updated_at' => '2021-11-22 08:20:39',
            ],
            2 => [
                'id' => 5,
                'country_id' => 3,
                'name' => 'Residencial',
                'created_at' => '2021-11-12 00:04:20',
                'updated_at' => '2021-11-12 00:04:20',
            ],
            3 => [
                'id' => 6,
                'country_id' => 3,
                'name' => 'No residencial',
                'created_at' => '2021-11-12 00:04:30',
                'updated_at' => '2021-11-12 00:04:30',
            ],
            4 => [
                'id' => 7,
                'country_id' => 2,
                'name' => 'Home',
                'created_at' => '2021-11-19 15:51:07',
                'updated_at' => '2021-11-19 15:51:07',
            ],
        ]);
    }
}
