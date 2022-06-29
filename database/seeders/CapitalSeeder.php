<?php

namespace Database\Seeders;

use App\Models\Admin\Capital;
use Illuminate\Database\Seeder;

class CapitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Capital::truncate();

        Capital::updateOrCreate(['name' => 'Continente', 'position' => 1, 'ramo_id' => 1, 'predefined' => 'continente']);
        Capital::updateOrCreate(['name' => 'Obras de Reforma', 'position' => 2, 'ramo_id' => 1]);
        Capital::updateOrCreate(['name' => 'Contenido', 'position' => 3, 'ramo_id' => 1, 'predefined' => 'contenido']);
        Capital::updateOrCreate(['name' => 'Joyas', 'position' => 4, 'ramo_id' => 1]);
        Capital::updateOrCreate(['name' => 'Responsabilidad Civil', 'position' => 5, 'ramo_id' => 1]);
        Capital::updateOrCreate(['name' => 'Defensa Jurídica', 'position' => 6, 'ramo_id' => 1]);
    }
}
