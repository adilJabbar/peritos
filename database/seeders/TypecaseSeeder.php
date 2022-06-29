<?php

namespace Database\Seeders;

use App\Models\Admin\Ramo;
use App\Models\Admin\Typecase;
use Illuminate\Database\Seeder;

class TypecaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Typecase::truncate();

        foreach (Ramo::all() as $ramo) {
            $ramo->typecases()->create([
                'name' => 'generico',
            ]);
            $ramo->typecases()->create([
                'name' => 'incendio',
                'texts' => 'incendio',
                'preexistences' => true,
                'tasacion' => true,
            ]);
            $ramo->typecases()->create([
                'name' => 'responsabilidad civil',
                'texts' => 'rc',
            ]);
            $ramo->typecases()->create([
                'name' => 'agua',
                'texts' => 'agua',
                'preexistences' => true,
                'tasacion' => true,
            ]);
        }
    }
}
