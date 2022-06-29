<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->delete();

        DB::table('currencies')->insert([
            0 => [
                'id' => 1,
                'name' => 'Euro',
                'currency' => '€',
                'iso' => 'EUR',
                'decimal' => ',',
                'separator' => '.',
                'decimals' => 2,
                'usd_rate' => '1.00',
                'position' => 'after',
                'created_at' => '2021-03-23 14:59:29',
                'updated_at' => '2021-03-23 14:59:29',
            ],
            1 => [
                'id' => 2,
                'name' => 'US Dollar',
                'currency' => '$',
                'iso' => 'USD',
                'decimal' => '.',
                'separator' => ',',
                'decimals' => 2,
                'usd_rate' => '1.00',
                'position' => 'before',
                'created_at' => '2021-03-23 14:59:29',
                'updated_at' => '2021-03-23 14:59:29',
            ],
            2 => [
                'id' => 3,
                'name' => 'PESO COLOMBIANO',
                'currency' => '$',
                'iso' => 'CPO',
                'decimal' => ',',
                'separator' => '.',
                'decimals' => 2,
                'usd_rate' => '3700.00',
                'position' => 'before',
                'created_at' => '2021-05-04 16:36:19',
                'updated_at' => '2021-11-12 15:21:52',
            ],
        ]);
    }
}
