<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->delete();

        DB::table('companies')->insert([
            0 => [
                'id' => 1,
                'name' => 'Mapfre',
                'legal_name' => 'MAPFRE ESPAÑA, COMPAÑÍA DE SEGUROS Y REASEGUROS, S.A',
                'legal_id' => 'A28141935',
                'url' => null,
                'logo' => 'tr4iMh8nTvz3JJlMrACBE13iY4lxkCggvX1HYRkV.jpg',
                'is_active' => 1,
                'created_at' => '2021-03-23 15:05:49',
                'updated_at' => '2021-03-23 20:43:20',
            ],
            1 => [
                'id' => 2,
                'name' => 'Mutua Madrileña',
                'legal_name' => 'MUTUA MADRILEÑA AUTOMOVILISTA SOCIEDAD DE SEGUROS A PRIMA FIJA',
                'legal_id' => 'V28027118',
                'url' => null,
                'logo' => 'lBR7TfKRB9Xt1xjE6Igexo0lz16cGdaamNYo5OGJ.png',
                'is_active' => 0,
                'created_at' => '2021-03-23 20:11:42',
                'updated_at' => '2021-03-23 20:12:13',
            ],
            2 => [
                'id' => 3,
                'name' => 'HDI SEGUROS S.A',
                'legal_name' => 'HDI SEGUROS S.A',
                'legal_id' => '8600048756',
                'url' => null,
                'logo' => 'iwQFBK6d8mpSw9wd27Ml1L0Gee6f4URmBogDrnmw.jpg',
                'is_active' => 1,
                'created_at' => '2021-11-12 14:24:36',
                'updated_at' => '2021-11-12 14:26:33',
            ],
            3 => [
                'id' => 4,
                'name' => 'Allianz ',
                'legal_name' => 'Allianz Colombia S.A',
                'legal_id' => '860026182-5',
                'url' => null,
                'logo' => 'UbtlcoQyYggfSymDYiclzJvfsi8qe6GorlwGCpU8.jpg',
                'is_active' => 1,
                'created_at' => '2021-11-19 16:11:53',
                'updated_at' => '2021-11-19 16:14:53',
            ],
            4 => [
                'id' => 5,
                'name' => 'Seguros Generales Suramericana S.A',
                'legal_name' => 'Suramericana',
                'legal_id' => '8909034079',
                'url' => null,
                'logo' => 'eDhAdyj0YG9vTSc2VwgGrvRIldUy8yXHiaKfSstp.jpg',
                'is_active' => 1,
                'created_at' => '2021-11-19 16:43:44',
                'updated_at' => '2021-11-19 16:44:43',
            ],
        ]);
    }
}
