<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeopleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('people')->delete();

        DB::table('people')->insert([
            0 => [
                'id' => 1,
                'name' => 'John Doe',
                'legal_id' => '111222333',
                'legal_name' => 'John Doe Corporation',
                'created_at' => '2021-11-11 18:06:48',
                'updated_at' => '2021-11-11 18:06:48',
            ],
        ]);
    }
}
