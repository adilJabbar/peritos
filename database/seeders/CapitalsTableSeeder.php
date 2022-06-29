<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CapitalsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('capitals')->delete();

        DB::table('capitals')->insert([
            0 => [
                'id' => 1,
                'name' => 'Continente',
                'position' => 1,
                'ramo_id' => 1,
                'predefined' => 'continente',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-11-11 14:58:41',
            ],
            1 => [
                'id' => 2,
                'name' => 'Obras de Reforma',
                'position' => 2,
                'ramo_id' => 1,
                'predefined' => null,
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-11-11 14:58:41',
            ],
            2 => [
                'id' => 3,
                'name' => 'Contenido',
                'position' => 3,
                'ramo_id' => 1,
                'predefined' => 'contenido',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-11-11 14:58:41',
            ],
            3 => [
                'id' => 4,
                'name' => 'Joyas',
                'position' => 4,
                'ramo_id' => 1,
                'predefined' => null,
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-11-11 14:58:41',
            ],
            4 => [
                'id' => 5,
                'name' => 'Responsabilidad Civil',
                'position' => 8,
                'ramo_id' => 1,
                'predefined' => null,
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-11-11 18:59:10',
            ],
            5 => [
                'id' => 6,
                'name' => 'Defensa Jurídica',
                'position' => 7,
                'ramo_id' => 1,
                'predefined' => null,
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-11-11 18:59:10',
            ],
            6 => [
                'id' => 8,
                'name' => 'Continente',
                'position' => 1,
                'ramo_id' => 5,
                'predefined' => null,
                'created_at' => '2021-11-11 17:01:51',
                'updated_at' => '2021-11-11 17:01:51',
            ],
            7 => [
                'id' => 9,
                'name' => 'Contenido',
                'position' => 2,
                'ramo_id' => 5,
                'predefined' => null,
                'created_at' => '2021-11-11 17:02:32',
                'updated_at' => '2021-11-11 17:02:32',
            ],
            8 => [
                'id' => 10,
                'name' => 'Existencias',
                'position' => 5,
                'ramo_id' => 1,
                'predefined' => null,
                'created_at' => '2021-11-11 18:55:29',
                'updated_at' => '2021-11-11 18:59:06',
            ],
            9 => [
                'id' => 11,
                'name' => 'Maquinaria',
                'position' => 5,
                'ramo_id' => 1,
                'predefined' => null,
                'created_at' => '2021-11-11 18:57:45',
                'updated_at' => '2021-11-11 18:59:06',
            ],
            10 => [
                'id' => 12,
                'name' => 'RC Explotación',
                'position' => 10,
                'ramo_id' => 1,
                'predefined' => null,
                'created_at' => '2021-11-11 18:57:55',
                'updated_at' => '2021-11-11 18:58:09',
            ],
            11 => [
                'id' => 13,
                'name' => 'Robo',
                'position' => 6,
                'ramo_id' => 1,
                'predefined' => null,
                'created_at' => '2021-11-11 18:58:06',
                'updated_at' => '2021-11-11 18:59:09',
            ],
        ]);
    }
}
