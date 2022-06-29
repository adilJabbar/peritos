<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        DB::table('products')->insert([
            0 => [
                'id' => 4,
                'name' => 'Hogar Global Mutua Madrileña',
                'code' => null,
                'current_version' => null,
                'notes' => null,
                'ramo_id' => 0,
                'company_id' => 0,
                'guarantee_order' => null,
                'cond_general' => 'uwV0R95M9KL6Q52O2aiQ1J1NP99EkYSugpjzQjIa.pdf',
                'active' => 1,
                'created_at' => '2021-11-18 20:13:18',
                'updated_at' => '2021-11-18 21:05:37',
            ],
        ]);
    }
}
