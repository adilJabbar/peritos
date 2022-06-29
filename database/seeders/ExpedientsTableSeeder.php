<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpedientsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('expedients')->delete();

        DB::table('expedients')->insert([
            0 => [
                'id' => 1,
                'code' => 1,
                'full_code' => 'AVA·202111·00001',
                'requested_at' => '2021-11-11 18:05:00',
                'happened_at' => '2021-11-12',
                'expires_at' => '2021-11-12 00:05:00',
                'billable_type' => \App\Models\Insurance\Company::class,
                'billable_id' => 1,
                'billable_address_id' => null,
                'priority' => 'normal',
                'reference' => '2123156456',
                'description' => '<div>Daños en el tejado del edificio por fuertes vientos</div>',
                'private_comments' => '',
                'ramo_id' => 1,
                'address_id' => 4,
                'person_id' => 1,
                'agent_id' => 2,
                'adjuster_id' => null,
                'status_id' => 1,
                'gabinete_id' => 1,
                'creator_id' => 1,
                'requires_policy' => 1,
                'policy_id' => 1,
                'created_at' => '2021-11-11 18:06:19',
                'updated_at' => '2021-11-11 18:07:51',
            ],
        ]);
    }
}
