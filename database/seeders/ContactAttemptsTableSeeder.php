<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactAttemptsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_attempts')->delete();

        DB::table('contact_attempts')->insert([
            0 => [
                'id' => 1,
                'expedient_id' => 10,
                'time' => '2022-03-21 22:40:49',
                'user_id' => 1,
                'attempt_type' => 'phone',
                'attempt_value' => '654654654',
                'get_response' => 1,
                'comments' => null,
                'response' => 'Client asks to call again later',
                'created_at' => '2022-03-21 22:40:49',
                'updated_at' => '2022-03-21 22:40:49',
            ],
            1 => [
                'id' => 2,
                'expedient_id' => 10,
                'time' => '2022-03-21 22:40:39',
                'user_id' => 0,
                'attempt_type' => 'phone',
                'attempt_value' => '654654654',
                'get_response' => 0,
                'comments' => null,
                'response' => null,
                'created_at' => '2022-03-21 22:40:46',
                'updated_at' => '2022-03-21 22:40:46',
            ],
            2 => [
                'id' => 3,
                'expedient_id' => 10,
                'time' => '2022-03-21 22:40:53',
                'user_id' => 1,
                'attempt_type' => 'phone',
                'attempt_value' => '654654654',
                'get_response' => 1,
                'comments' => 'Client very nervous becase he has been waiting this call the whole day.',
                'response' => 'Visit scheduled with technician',
                'created_at' => '2022-03-21 22:41:47',
                'updated_at' => '2022-03-21 22:41:47',
            ],
        ]);
    }
}
