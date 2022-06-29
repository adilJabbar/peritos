<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GabinetesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('gabinetes')->delete();

        DB::table('gabinetes')->insert([
            0 => [
                'id' => 1,
                'name' => 'Avalon Spain',
                'legal_name' => 'Avalon Risk Management Centro, SL',
                'legal_id' => 'B85404440',
                'email' => 'erchecho@gmail.com',
                'phone' => '918007562',
                'address' => 'Av. Castilla, 53, planta 2',
                'city' => 'San Fernando de Henares',
                'zip' => '28830',
                'state' => 'Madrid',
                'country_id' => 1,
                'www' => 'https://avalonspain.es',
                'logo' => 'OspwxGhN95byPTSINpLW7uFFgUud18bfq8XjaeeZ.png',
                'logo_horiz' => 'KuN1m0Pq6aeWtbv3gLhB2fAhUkrDDLiSsyDuDklh.png',
                'logo_icon' => null,
                'main_color' => null,
                'main_color_text' => null,
                'secondary_color' => null,
                'secondary_color_text' => null,
                'is_active' => 1,
                'create_main_user_token' => null,
                'token_expires' => null,
                'created_at' => '2021-11-11 14:58:40',
                'updated_at' => '2021-11-11 16:22:20',
                'advance_id' => 1,
                'preReport_id' => 2,
                'report_id' => 3,
                'invoice_id' => 4,
            ],
            1 => [
                'id' => 22,
                'name' => '360 Claims',
                'legal_name' => '360 Claims&Solutions',
                'legal_id' => null,
                'email' => 's.valera@avalonspain.es',
                'phone' => null,
                'address' => 'Miami',
                'city' => 'Miami',
                'zip' => null,
                'state' => 'Florida',
                'country_id' => 2,
                'www' => null,
                'logo' => 'irrMNhCn9seqFOtxwISJSV70mdoOsGos6wwrjjcS.png',
                'logo_horiz' => 'Yht5HRtZkR6H0O7Mc66shDgnwnDvzlRsZQ9w2rCh.png',
                'logo_icon' => 'rLbr6OSolr3WlVNgo4lb34tsWeflJwCh5UAtKdJV.png',
                'main_color' => null,
                'main_color_text' => null,
                'secondary_color' => null,
                'secondary_color_text' => null,
                'is_active' => 1,
                'create_main_user_token' => 'b4280b4a6836bb4dc657c15b3bf023dfbbc672b249f9c58943db6e9e63dffad42239c59defcff348',
                'token_expires' => '2021-11-11 16:32:48',
                'created_at' => '2021-11-11 16:02:07',
                'updated_at' => '2021-11-11 16:02:48',
                'advance_id' => 1,
                'preReport_id' => 2,
                'report_id' => 3,
                'invoice_id' => 4,
            ],
        ]);
    }
}
