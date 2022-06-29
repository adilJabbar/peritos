<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoBonusesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('video_bonuses')->delete();

        DB::table('video_bonuses')->insert([
            0 => [
                'id' => 1,
                'name' => 'shy',
                'minutes' => 300,
                'amount' => 5.0,
                'stripe_id' => null,
                'created_at' => '2022-03-27 23:14:56',
                'updated_at' => '2022-03-27 23:14:56',
            ],
            1 => [
                'id' => 2,
                'name' => 'curious',
                'minutes' => 600,
                'amount' => 10.0,
                'stripe_id' => null,
                'created_at' => '2022-03-27 23:15:11',
                'updated_at' => '2022-03-27 23:15:11',
            ],
            2 => [
                'id' => 3,
                'name' => 'talker',
                'minutes' => 1500,
                'amount' => 15.0,
                'stripe_id' => null,
                'created_at' => '2022-03-27 23:15:23',
                'updated_at' => '2022-03-27 23:15:23',
            ],
        ]);
    }
}
