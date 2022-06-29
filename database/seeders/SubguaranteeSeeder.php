<?php

namespace Database\Seeders;

use App\Models\Insurance\Subguarantee;
use Illuminate\Database\Seeder;

class SubguaranteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subguarantee::updateOrCreate(['name' => 'Localización y Reparación', 'guarantee_id' => 1], [
            'percent_covered' => '100',
            'limit' => '300',
            'percent_deductible' => '15',
            'min_deductible' => '50',
            'max_deductible' => '100',
            'notes' => 'No se cubre la localización en exteriores',
            'included' => '1',
            'primer_riesgo' => '1',
        ]);
        Subguarantee::updateOrCreate(['name' => 'Daños por agua', 'guarantee_id' => 1], [
            'percent_covered' => '100',
            'included' => '1',
        ]);
        Subguarantee::updateOrCreate(['name' => 'Limpieza', 'guarantee_id' => 2], [
            'percent_covered' => '100',
            'min_deductible' => '50',
            'max_deductible' => '100',
            'included' => '1',
        ]);
        Subguarantee::updateOrCreate(['name' => 'Daños por incendio', 'guarantee_id' => 2], [
            'percent_covered' => '100',
            'included' => '1',
        ]);
        Subguarantee::updateOrCreate(['name' => 'Reparación de la causa', 'guarantee_id' => 3], [
            'percent_covered' => '0',
            'included' => '1',
        ]);
        Subguarantee::updateOrCreate(['name' => 'Valoración de daños', 'guarantee_id' => 3], [
            'percent_covered' => '100',
            'included' => '1',
        ]);
        Subguarantee::updateOrCreate(['name' => 'Resposabilidad Civil', 'guarantee_id' => 4], [
            'percent_covered' => '0',
            'included' => '1',
            'primer_riesgo' => '1',
        ]);
    }
}
