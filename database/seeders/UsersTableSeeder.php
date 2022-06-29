<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            0 => [
                'id' => 1,
                'name' => 'Sergio',
                'last_name' => 'Valera',
                'email' => 'erchecho@gmail.com',
                'email_verified_at' => '2021-11-11 14:58:40',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => 'HudkE997ep',
                'language' => 'es',
                'birthday' => null,
                'is_active' => 1,
                'current_team_id' => null,
                'profile_photo_path' => null,
                'timezone' => 'America/Chicago',
                'country_id' => 1,
                'created_at' => '2021-11-11 14:58:40',
                'updated_at' => '2021-11-11 15:06:31',
            ],
            1 => [
                'id' => 2,
                'name' => 'Ricardo',
                'last_name' => 'Arias',
                'email' => 's.valera@avalonspain.net',
                'email_verified_at' => '2021-11-11 16:23:09',
                'password' => '$2y$10$ytQ45N9rziwYCv7OGQLwxO3vXDFYN5ud/pwV0xDQUcXUjHQpe0a0u',
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => 'XDghxPZVxUCXD8zp1oFQk2Rl7SkBPGL65hDQ9SfFLftZdzivSIxQKkBYGObk',
                'language' => 'es',
                'birthday' => null,
                'is_active' => 1,
                'current_team_id' => null,
                'profile_photo_path' => null,
                'timezone' => 'America/Chicago',
                'country_id' => 1,
                'created_at' => '2021-11-11 16:22:20',
                'updated_at' => '2021-11-11 16:23:10',
            ],
            2 => [
                'id' => 3,
                'name' => 'Silvia',
                'last_name' => 'Revuelta',
                'email' => 'sergio@valera.name',
                'email_verified_at' => null,
                'password' => '$2y$10$FEPVFDoGVew.gowlrbgwsuSRiEBYhHFNBU4XoWxti/ZT5li5idmmW',
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'remember_token' => null,
                'language' => 'es',
                'birthday' => null,
                'is_active' => 1,
                'current_team_id' => null,
                'profile_photo_path' => null,
                'timezone' => null,
                'country_id' => 1,
                'created_at' => '2021-11-11 16:28:55',
                'updated_at' => '2021-11-11 16:28:55',
            ],
        ]);
    }
}
