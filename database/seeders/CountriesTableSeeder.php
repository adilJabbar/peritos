<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();

        DB::table('countries')->insert([
            0 => [
                'id' => 1,
                'name' => 'Spain',
                'code' => 'es',
                'currency_id' => 1,
                'taxes' => '21.00',
                'reduced_taxes' => '10.00',
                'precio_m' => '600.00',
                'seg_salud' => '150.00',
                'benef_ind_perc' => '6.00',
                'gastos_generales_perc' => '13.00',
                'arquitecto_perc' => '10.00',
                'license_perc' => '3.00',
                'furniture' => 15000,
                'room' => 3500,
                'person' => 3000,
                'anexo' => 1500,
                'flag' => 'img/flags/juneOlKPsMskghPQy9An05pT6zBRaWkH4iYfXmYL.jpg',
                'created_at' => '2021-03-23 14:59:32',
                'updated_at' => '2021-03-23 19:21:28',
            ],
            1 => [
                'id' => 2,
                'name' => 'United States',
                'code' => 'us',
                'currency_id' => 2,
                'taxes' => '9.15',
                'reduced_taxes' => '10.00',
                'precio_m' => '900.00',
                'seg_salud' => '150.00',
                'benef_ind_perc' => '6.00',
                'gastos_generales_perc' => '13.00',
                'arquitecto_perc' => '10.00',
                'license_perc' => '3.00',
                'furniture' => null,
                'room' => null,
                'person' => null,
                'anexo' => null,
                'flag' => 'img/flags/dYC1rlI7vGWynY9aDj8thWFGmgSV0gRT3E1jLPEE.jpg',
                'created_at' => '2021-03-23 14:59:32',
                'updated_at' => '2021-03-23 20:42:54',
            ],
            2 => [
                'id' => 3,
                'name' => 'Italy',
                'code' => 'it',
                'currency_id' => 1,
                'taxes' => '25.00',
                'reduced_taxes' => '10.00',
                'precio_m' => '600.00',
                'seg_salud' => '150.00',
                'benef_ind_perc' => '6.00',
                'gastos_generales_perc' => '13.00',
                'arquitecto_perc' => '10.00',
                'license_perc' => '3.00',
                'furniture' => null,
                'room' => null,
                'person' => null,
                'anexo' => null,
                'flag' => null,
                'created_at' => '2021-03-23 14:59:32',
                'updated_at' => '2021-03-23 14:59:32',
            ],
            3 => [
                'id' => 4,
                'name' => 'COLOMBIA',
                'code' => 'COL',
                'currency_id' => 3,
                'taxes' => '17.00',
                'reduced_taxes' => null,
                'precio_m' => '2385654.76',
                'seg_salud' => null,
                'benef_ind_perc' => null,
                'gastos_generales_perc' => null,
                'arquitecto_perc' => null,
                'license_perc' => null,
                'furniture' => 30873252,
                'room' => 8037203,
                'person' => 4000000,
                'anexo' => 3000000,
                'flag' => 'img/flags/Z7duR7LCebn9zVdaJP2k6mlRCJfzxe0edy7dWtu6.jpg',
                'created_at' => '2021-05-04 16:37:21',
                'updated_at' => '2021-11-12 15:17:28',
            ],
        ]);
    }
}
