<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpedientTypecaseTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('expedient_typecase')->delete();

        DB::table('expedient_typecase')->insert([
            0 => [
                'id' => 2,
                'expedient_id' => 1,
                'typecase_id' => 20,
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
