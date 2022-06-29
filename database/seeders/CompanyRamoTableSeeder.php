<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyRamoTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_ramo')->delete();

        DB::table('company_ramo')->insert([
            0 => [
                'id' => 1,
                'company_id' => 1,
                'ramo_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
