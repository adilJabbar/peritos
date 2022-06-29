<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->delete();

        DB::table('statuses')->insert([
            0 => [
                'id' => 1,
                'order' => 3,
                'name' => 'Finalizar Alta',
                'created_at' => '2021-12-30 14:26:19',
                'updated_at' => '2021-12-30 14:26:19',
            ],
            1 => [
                'id' => 2,
                'order' => 5,
                'name' => 'Pendiente de contacto',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:40:56',
            ],
            2 => [
                'id' => 3,
                'order' => 10,
                'name' => 'Contactado',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:40:59',
            ],
            3 => [
                'id' => 4,
                'order' => 15,
                'name' => 'Visita programada',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:07',
            ],
            4 => [
                'id' => 5,
                'order' => 30,
                'name' => 'Visita realizada',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:09',
            ],
            5 => [
                'id' => 6,
                'order' => 35,
                'name' => 'Primer avance enviado',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:11',
            ],
            6 => [
                'id' => 7,
                'order' => 40,
                'name' => 'Esperando documentación',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:13',
            ],
            7 => [
                'id' => 8,
                'order' => 50,
                'name' => 'Estudiando documentación',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:14',
            ],
            8 => [
                'id' => 9,
                'order' => 70,
                'name' => 'Informe en redacción',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:16',
            ],
            9 => [
                'id' => 10,
                'order' => 80,
                'name' => 'Acualizando informe',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:20',
            ],
            10 => [
                'id' => 11,
                'order' => 90,
                'name' => 'Informe en revisión',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:22',
            ],
            11 => [
                'id' => 12,
                'order' => 95,
                'name' => 'Informe revisado',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:29',
            ],
            12 => [
                'id' => 13,
                'order' => 100,
                'name' => 'Informe enviado',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:31',
            ],
            13 => [
                'id' => 14,
                'order' => 110,
                'name' => 'Juicio señalado',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:34',
            ],
            14 => [
                'id' => 15,
                'order' => 120,
                'name' => 'Facturado',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:36',
            ],
            15 => [
                'id' => 16,
                'order' => 125,
                'name' => 'Incluido en remesa',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:37',
            ],
            16 => [
                'id' => 17,
                'order' => 130,
                'name' => 'Cobrado',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:39',
            ],
            17 => [
                'id' => 18,
                'order' => 140,
                'name' => 'Liquidado',
                'created_at' => '2021-11-11 14:58:41',
                'updated_at' => '2021-12-27 20:41:41',
            ],
        ]);
    }
}
