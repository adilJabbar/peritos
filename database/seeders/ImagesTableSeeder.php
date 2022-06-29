<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->delete();

        DB::table('images')->insert([
            0 => [
                'id' => 1,
                'imageable_type' => \App\Models\Preexistence\HomePreexistence::class,
                'imageable_id' => 1,
                'name' => 'Foto Exterior',
                'path' => '5aNVi0lTNV1QPRkYQLT1XXWfiQm9RcMgdOlfNHdQ.jpg',
                'group' => 'OutsidePhoto',
                'comments' => null,
                'created_at' => '2021-11-11 18:11:05',
                'updated_at' => '2021-11-11 18:11:05',
            ],
            1 => [
                'id' => 2,
                'imageable_type' => \App\Models\Preexistence\HomePreexistence::class,
                'imageable_id' => 1,
                'name' => 'Foto Interior',
                'path' => '2TPBJVw47JAdXZtQJ1WxsoXBI9U6K0jvSqOqaxmQ.jpg',
                'group' => 'InsidePhoto',
                'comments' => null,
                'created_at' => '2021-11-11 18:11:11',
                'updated_at' => '2021-11-11 18:11:11',
            ],
        ]);
    }
}
