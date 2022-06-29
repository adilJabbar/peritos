<?php

namespace Database\Seeders;

use App\Models\Documentversion;
use Illuminate\Database\Seeder;

class DocumentversionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Documentversion::updateOrCreate(['id' => 1], [
            'type' => 'advance',
            'name' => 'default',
            'path' => 'pdfTemplates.advances.default',
        ]);
        Documentversion::updateOrCreate(['id' => 2], [
            'type' => 'prereport',
            'name' => 'default',
            'path' => 'pdfTemplates.prereport.default',
        ]);
        Documentversion::updateOrCreate(['id' => 3], [
            'type' => 'report',
            'name' => 'default',
            'path' => 'pdfTemplates.report.default',
        ]);
        Documentversion::updateOrCreate(['id' => 4], [
            'type' => 'invoice',
            'name' => 'default',
            'path' => 'pdfTemplates.invoice.default',
        ]);
    }
}
