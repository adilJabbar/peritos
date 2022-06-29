<?php

namespace Database\Seeders;

use App\Models\Insurance\Guarantee;
use Illuminate\Database\Seeder;

class GuaranteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guarantee::updateOrCreate(['product_id' => 1, 'name' => 'Agua']);
        Guarantee::updateOrCreate(['product_id' => 1, 'name' => 'Incendio']);
        Guarantee::updateOrCreate(['product_id' => 1, 'name' => 'Defensa Jurídica']);
        Guarantee::updateOrCreate(['product_id' => 1, 'name' => 'Responsabilidad Civil']);
    }
}
