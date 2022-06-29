<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductSeeder::class);
        $this->call(GuaranteeSeeder::class);
        $this->call(SubguaranteeSeeder::class);
    }
}
