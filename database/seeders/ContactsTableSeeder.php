<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->delete();

        DB::table('contacts')->insert([
            0 => [
                'id' => 1,
                'contactable_type' => \App\Models\Person::class,
                'contactable_id' => 1,
                'type' => 'phone',
                'value' => '456789789',
                'created_at' => '2021-11-11 18:07:51',
                'updated_at' => '2021-11-11 18:07:51',
            ],
        ]);
    }
}
