<?php

namespace Database\Seeders;

use App\Models\Admin\Destiny;
use Illuminate\Database\Seeder;

class DestinySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Destiny::truncate();

        Destiny::create(['code' => 'Ind', 'name' => 'Indemnización', 'covered' => 1]);
        Destiny::create(['code' => 'Rep', 'name' => 'Reparación', 'covered' => 1]);
        Destiny::create(['code' => 'Exc', 'name' => 'Excluido', 'covered' => 0]);
        Destiny::create(['code' => 'N/C', 'name' => 'No Cubierto', 'covered' => 0]);
    }
}
