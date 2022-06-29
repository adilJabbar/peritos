<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentversionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('documentversions')->delete();

        DB::table('documentversions')->insert([
            0 => [
                'id' => 1,
                'type' => 'advance',
                'name' => 'default',
                'path' => 'pdfTemplates/advances/default',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
