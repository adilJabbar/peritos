<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RamosTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('ramos')->delete();

        DB::table('ramos')->insert([
            0 => [
                'id' => 1,
                'name' => 'Hogar',
                'country_id' => '1',
                'icon' => 'img/icons/1GV8ovQU2elx2efToberOfft3dNXSxgJMX1KyiCe.png',
                'capitals_order' => null,
                'preexistence_class_id' => 1,
                'created_at' => '2021-11-11 14:58:40',
                'updated_at' => '2021-11-11 16:54:22',
            ],
            1 => [
                'id' => 2,
                'name' => 'Comunidades',
                'country_id' => '1',
                'icon' => 'img/icons/7pFXGLXaGxq14Yu7sVdXaJcZdnqePU12zlw1EErd.png',
                'capitals_order' => null,
                'preexistence_class_id' => 0,
                'created_at' => '2021-11-11 14:58:40',
                'updated_at' => '2021-11-11 16:54:15',
            ],
            2 => [
                'id' => 3,
                'name' => 'Negocios',
                'country_id' => '1',
                'icon' => 'img/icons/v5sjYnuddXCcG3DKtPGV5w2O1lrnsVOZi2OrO5ob.png',
                'capitals_order' => null,
                'preexistence_class_id' => 0,
                'created_at' => '2021-11-11 14:58:40',
                'updated_at' => '2021-11-11 16:54:32',
            ],
            3 => [
                'id' => 4,
                'name' => 'Transporte',
                'country_id' => '1',
                'icon' => 'img/icons/5i4qPGCf4ggeRoRcHeLQklWvzgEVB5SH26KyLjwF.png',
                'capitals_order' => null,
                'preexistence_class_id' => 0,
                'created_at' => '2021-11-11 14:58:40',
                'updated_at' => '2021-11-11 16:54:38',
            ],
            4 => [
                'id' => 5,
                'name' => 'Home',
                'country_id' => '2',
                'icon' => 'img/icons/67bxsYMObqxsXClKuza3XfiZG3DoOTipA4t03t5k.png',
                'capitals_order' => null,
                'preexistence_class_id' => 1,
                'created_at' => '2021-11-11 16:57:36',
                'updated_at' => '2021-11-11 17:06:17',
            ],
            5 => [
                'id' => 6,
                'name' => 'Business',
                'country_id' => '2',
                'icon' => 'img/icons/ZdkzACfm86lXw9gHXdVhv5D1AZzG2tTp0UkHmzzM.png',
                'capitals_order' => null,
                'preexistence_class_id' => 0,
                'created_at' => '2021-11-11 16:57:43',
                'updated_at' => '2021-11-11 16:58:28',
            ],
            6 => [
                'id' => 7,
                'name' => 'Liability',
                'country_id' => '2',
                'icon' => 'img/icons/lsgZ8BtF4dLaMHPe1VBKQ6RUTVX6UrrL95cab0Ls.png',
                'capitals_order' => null,
                'preexistence_class_id' => 0,
                'created_at' => '2021-11-11 16:57:48',
                'updated_at' => '2021-11-11 16:59:21',
            ],
            7 => [
                'id' => 8,
                'name' => 'Transport',
                'country_id' => '2',
                'icon' => 'img/icons/67rzXXtyru0vMDnZLN8WN1uVOCGfAbOJ7ELXR4zW.png',
                'capitals_order' => null,
                'preexistence_class_id' => 0,
                'created_at' => '2021-11-11 16:57:54',
                'updated_at' => '2021-11-11 16:59:28',
            ],
        ]);
    }
}
