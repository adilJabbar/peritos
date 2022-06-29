<?php

namespace Database\Seeders;

use App\Models\Admin\PreexistenceClass;
use Illuminate\Database\Seeder;

class PreexistenceClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PreexistenceClass::truncate();

        PreexistenceClass::create([
            'name' => 'home',
            'class' => 'homepreexistence',
        ]);
        PreexistenceClass::create([
            'name' => 'business',
            'class' => 'businesspreexistence',
        ]);
    }
}
