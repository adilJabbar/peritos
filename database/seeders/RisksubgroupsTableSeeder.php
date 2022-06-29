<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RisksubgroupsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('risksubgroups')->delete();

        DB::table('risksubgroups')->insert([
            0 => [
                'id' => 1,
                'riskgroup_id' => 2,
                'name' => 'En altura',
                'created_at' => '2021-03-23 15:01:12',
                'updated_at' => '2021-03-23 15:01:12',
            ],
            1 => [
                'id' => 2,
                'riskgroup_id' => 2,
                'name' => 'Unifamiliares',
                'created_at' => '2021-03-23 15:01:12',
                'updated_at' => '2021-03-23 15:01:12',
            ],
            2 => [
                'id' => 5,
                'riskgroup_id' => 6,
                'name' => 'Oficina',
                'created_at' => null,
                'updated_at' => null,
            ],
            3 => [
                'id' => 6,
                'riskgroup_id' => 6,
                'name' => 'Consultorio',
                'created_at' => null,
                'updated_at' => null,
            ],
            4 => [
                'id' => 7,
                'riskgroup_id' => 6,
                'name' => 'Local',
                'created_at' => null,
                'updated_at' => null,
            ],
            5 => [
                'id' => 8,
                'riskgroup_id' => 6,
                'name' => 'Garaje',
                'created_at' => null,
                'updated_at' => null,
            ],
            6 => [
                'id' => 9,
                'riskgroup_id' => 6,
                'name' => 'Edificio',
                'created_at' => null,
                'updated_at' => null,
            ],
            7 => [
                'id' => 10,
                'riskgroup_id' => 6,
                'name' => 'Dotacional',
                'created_at' => null,
                'updated_at' => null,
            ],
            8 => [
                'id' => 11,
                'riskgroup_id' => 5,
                'name' => 'Casa',
                'created_at' => null,
                'updated_at' => null,
            ],
            9 => [
                'id' => 12,
                'riskgroup_id' => 5,
                'name' => 'Apartamento',
                'created_at' => null,
                'updated_at' => null,
            ],
            10 => [
                'id' => 20,
                'riskgroup_id' => 6,
                'name' => 'Bodega',
                'created_at' => '2021-11-11 19:36:33',
                'updated_at' => null,
            ],
            11 => [
                'id' => 21,
                'riskgroup_id' => 7,
                'name' => 'Townhomes',
                'created_at' => '2021-11-19 15:51:21',
                'updated_at' => '2021-11-19 15:51:21',
            ],
            12 => [
                'id' => 23,
                'riskgroup_id' => 1,
                'name' => 'Comercios',
                'created_at' => null,
                'updated_at' => null,
            ],
            13 => [
                'id' => 24,
                'riskgroup_id' => 1,
                'name' => 'Deportivos',
                'created_at' => null,
                'updated_at' => null,
            ],
            14 => [
                'id' => 25,
                'riskgroup_id' => 1,
                'name' => 'Docente',
                'created_at' => null,
                'updated_at' => null,
            ],
            15 => [
                'id' => 26,
                'riskgroup_id' => 1,
                'name' => 'Espectáculos',
                'created_at' => null,
                'updated_at' => null,
            ],
            16 => [
                'id' => 27,
                'riskgroup_id' => 1,
                'name' => 'Funerario',
                'created_at' => null,
                'updated_at' => null,
            ],
            17 => [
                'id' => 28,
                'riskgroup_id' => 1,
                'name' => 'Garaje',
                'created_at' => null,
                'updated_at' => null,
            ],
            18 => [
                'id' => 29,
                'riskgroup_id' => 1,
                'name' => 'Hostelería',
                'created_at' => null,
                'updated_at' => null,
            ],
            19 => [
                'id' => 30,
                'riskgroup_id' => 1,
                'name' => 'Industrial y agropecuario',
                'created_at' => null,
                'updated_at' => null,
            ],
            20 => [
                'id' => 31,
                'riskgroup_id' => 1,
                'name' => 'Oficinas',
                'created_at' => null,
                'updated_at' => null,
            ],
            21 => [
                'id' => 32,
                'riskgroup_id' => 1,
                'name' => 'Religioso',
                'created_at' => null,
                'updated_at' => null,
            ],
            22 => [
                'id' => 33,
                'riskgroup_id' => 1,
                'name' => 'Sanitario',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
