<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CapitalProductTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('capital_product')->delete();

        DB::table('capital_product')->insert([
            0 => [
                'id' => 1,
                'capital_id' => 1,
                'product_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            1 => [
                'id' => 2,
                'capital_id' => 2,
                'product_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            2 => [
                'id' => 3,
                'capital_id' => 3,
                'product_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            3 => [
                'id' => 4,
                'capital_id' => 1,
                'product_id' => 2,
                'created_at' => null,
                'updated_at' => null,
            ],
            4 => [
                'id' => 5,
                'capital_id' => 4,
                'product_id' => 2,
                'created_at' => null,
                'updated_at' => null,
            ],
            5 => [
                'id' => 6,
                'capital_id' => 5,
                'product_id' => 2,
                'created_at' => null,
                'updated_at' => null,
            ],
            6 => [
                'id' => 7,
                'capital_id' => 10,
                'product_id' => 1,
                'created_at' => '2021-11-11 12:56:52',
                'updated_at' => null,
            ],
            7 => [
                'id' => 8,
                'capital_id' => 11,
                'product_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
            8 => [
                'id' => 9,
                'capital_id' => 12,
                'product_id' => 1,
                'created_at' => '2021-11-11 12:59:47',
                'updated_at' => null,
            ],
            9 => [
                'id' => 10,
                'capital_id' => 13,
                'product_id' => 1,
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
