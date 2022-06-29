<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->delete();

        DB::table('addresses')->insert([
            0 => [
                'id' => 1,
                'addressable_type' => \App\Models\Insurance\Company::class,
                'addressable_id' => 1,
                'name' => null,
                'address' => 'Pº Castellana 100',
                'city' => 'Madrid',
                'state' => 'Madrid',
                'zip' => '28001',
                'country_id' => 1,
                'latitude' => null,
                'longitude' => null,
                'preexistenceable_type' => null,
                'preexistenceable_id' => null,
                'created_at' => '2021-11-11 14:58:40',
                'updated_at' => '2021-11-11 17:59:19',
            ],
            1 => [
                'id' => 2,
                'addressable_type' => \App\Models\Insurance\Company::class,
                'addressable_id' => 2,
                'name' => 'Oficinas principales Sevilla',
                'address' => 'Av Guadiana',
                'city' => 'Sevilla',
                'state' => 'Sevilla',
                'zip' => '06123',
                'country_id' => 1,
                'latitude' => null,
                'longitude' => null,
                'preexistenceable_type' => null,
                'preexistenceable_id' => null,
                'created_at' => '2021-11-11 16:46:27',
                'updated_at' => '2021-11-11 16:46:27',
            ],
            2 => [
                'id' => 3,
                'addressable_type' => \App\Models\Insurance\Company::class,
                'addressable_id' => 3,
                'name' => null,
                'address' => '2134 Main St',
                'city' => 'Kansas City',
                'state' => 'Kansas',
                'zip' => '66645',
                'country_id' => 2,
                'latitude' => null,
                'longitude' => null,
                'preexistenceable_type' => null,
                'preexistenceable_id' => null,
                'created_at' => '2021-11-11 16:47:17',
                'updated_at' => '2021-11-11 16:47:17',
            ],
            3 => [
                'id' => 4,
                'addressable_type' => \App\Models\Person::class,
                'addressable_id' => 1,
                'name' => null,
                'address' => 'Av castilla 55',
                'city' => 'San Fernando De Henares',
                'state' => 'Madrid',
                'zip' => '28830',
                'country_id' => 1,
                'latitude' => null,
                'longitude' => null,
                'preexistenceable_type' => \App\Models\Preexistence\HomePreexistence::class,
                'preexistenceable_id' => 1,
                'created_at' => '2021-11-11 18:06:55',
                'updated_at' => '2021-11-11 18:09:37',
            ],
        ]);
    }
}
