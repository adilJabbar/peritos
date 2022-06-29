<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliciesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('policies')->delete();

        DB::table('policies')->insert([
            0 => [
                'id' => 1,
                'company_id' => 1,
                'product_id' => 1,
                'person_id' => 1,
                'name_cia' => null,
                'reference' => '46589894646',
                'cond_particular' => 'TlHFv6ktXno6ZsTOqZrwACUBRHwLDA0NI5Hhcja3.png',
                'created_at' => '2021-11-11 18:06:19',
                'updated_at' => '2021-11-11 18:07:51',
            ],
        ]);
    }
}
