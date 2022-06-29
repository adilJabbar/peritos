<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstimationsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('estimations')->delete();

        DB::table('estimations')->insert([
            0 => [
                'id' => 1,
                'expedient_id' => 1,
                'estimation' => '25000.00',
                'reparation' => null,
                'indemnization' => null,
                'not_covered' => null,
                'origin' => 'initial',
                'currency_id' => 1,
                'created_at' => '2021-11-11 18:06:19',
                'updated_at' => '2021-11-11 18:07:51',
            ],
        ]);
    }
}
