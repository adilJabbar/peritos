<?php

namespace Database\Seeders;

use App\Models\Admin\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();

        Status::create([
            'order' => 5,
            'name' => 'pendiente de contacto',
        ]);
        Status::create([
            'order' => 10,
            'name' => 'contactado',
        ]);
        Status::create([
            'order' => 15,
            'name' => 'visita programada',
        ]);
        Status::create([
            'order' => 30,
            'name' => 'visita realizada',
        ]);
        Status::create([
            'order' => 35,
            'name' => 'primer avance enviado',
        ]);
        Status::create([
            'order' => 40,
            'name' => 'esperando documentación',
        ]);
        Status::create([
            'order' => 50,
            'name' => 'estudiando documentación',
        ]);
        Status::create([
            'order' => 70,
            'name' => 'informe en redacción',
        ]);
        Status::create([
            'order' => 80,
            'name' => 'acualizando informe',
        ]);
        Status::create([
            'order' => 90,
            'name' => 'informe en revisión',
        ]);
        Status::create([
            'order' => 95,
            'name' => 'informe revisado',
        ]);
        Status::create([
            'order' => 100,
            'name' => 'informe enviado',
        ]);
        Status::create([
            'order' => 110,
            'name' => 'juicio señalado',
        ]);
        Status::create([
            'order' => 120,
            'name' => 'facturado',
        ]);
        Status::create([
            'order' => 125,
            'name' => 'incluido en remesa',
        ]);
        Status::create([
            'order' => 130,
            'name' => 'cobrado',
        ]);
        Status::create([
            'order' => 140,
            'name' => 'liquidado',
        ]);
    }
}
