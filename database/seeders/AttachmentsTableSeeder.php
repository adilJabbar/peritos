<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttachmentsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('attachments')->delete();

        DB::table('attachments')->insert([
            0 => [
                'id' => 1,
                'attachable_type' => \App\Models\Expedient::class,
                'attachable_id' => 1,
                'name' => '1200px-Farmers_Insurance_Group_logo.svg',
                'path' => 'VLlEkc8dD10iBBQydf9DpyR4SzzgO98Qu7q3NpGL.png',
                'comments' => null,
                'created_at' => '2021-11-11 18:07:51',
                'updated_at' => '2021-11-11 18:07:51',
            ],
        ]);
    }
}
