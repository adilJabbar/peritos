<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CapitalPolicyTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('capital_policy')->delete();

        DB::table('capital_policy')->insert([
            0 => [
                'id' => 1,
                'capital_id' => 1,
                'policy_id' => 1,
                'amount' => '250000.00',
                'primer_riesgo' => 0,
                'perc_cia' => '100',
                'reposicion' => '236685.00',
                'deprecation' => '16.00',
                'created_at' => null,
                'updated_at' => null,
            ],
            1 => [
                'id' => 3,
                'capital_id' => 10,
                'policy_id' => 1,
                'amount' => '270000.00',
                'primer_riesgo' => 0,
                'perc_cia' => '100',
                'reposicion' => '350000.00',
                'deprecation' => '0.00',
                'created_at' => null,
                'updated_at' => null,
            ],
            2 => [
                'id' => 4,
                'capital_id' => 13,
                'policy_id' => 1,
                'amount' => '210000.00',
                'primer_riesgo' => 0,
                'perc_cia' => '100',
                'reposicion' => null,
                'deprecation' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
            3 => [
                'id' => 5,
                'capital_id' => 12,
                'policy_id' => 1,
                'amount' => '300000.00',
                'primer_riesgo' => 1,
                'perc_cia' => '100',
                'reposicion' => null,
                'deprecation' => null,
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
