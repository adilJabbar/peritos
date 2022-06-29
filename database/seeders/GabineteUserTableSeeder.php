<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GabineteUserTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('gabinete_user')->delete();

        DB::table('gabinete_user')->insert([
            0 => [
                'id' => 1,
                'gabinete_id' => 1,
                'user_id' => 1,
                'favorite' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            1 => [
                'id' => 2,
                'gabinete_id' => 2,
                'user_id' => 1,
                'favorite' => 0,
                'created_at' => null,
                'updated_at' => null,
            ],
            2 => [
                'id' => 3,
                'gabinete_id' => 1,
                'user_id' => 2,
                'favorite' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            3 => [
                'id' => 4,
                'gabinete_id' => 1,
                'user_id' => 3,
                'favorite' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
