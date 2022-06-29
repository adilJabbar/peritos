<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->delete();

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET_KEY')
        );
        $packages = [
            0 => [
                'id' => 1,
                'name' => 'Free',
                'expedients' => 2,
                'users' => 1,
                'video_minutes' => '5.00',
                'usd_month' => '0.00',
                'usd_year' => '0.00',
                'usd_expedient' => '5.00',
                'usd_user' => '50.00',
                'stripe_id' => null,
                'created_at' => '2022-03-27 23:16:38',
                'updated_at' => '2022-03-27 23:16:38',
            ],
            1 => [
                'id' => 2,
                'name' => 'Basic',
                'expedients' => 25,
                'users' => 2,
                'video_minutes' => '100.00',
                'usd_month' => '30.00',
                'usd_year' => '300.00',
                'usd_expedient' => '1.00',
                'usd_user' => '20.00',
                'stripe_id' => null,
                'created_at' => '2022-03-27 23:16:38',
                'updated_at' => '2022-03-27 23:16:38',
            ],
            2 => [
                'id' => 3,
                'name' => 'Medium',
                'expedients' => 70,
                'users' => 4,
                'video_minutes' => '300.00',
                'usd_month' => '70.00',
                'usd_year' => '700.00',
                'usd_expedient' => '0.75',
                'usd_user' => '15.00',
                'stripe_id' => null,
                'created_at' => '2022-03-27 23:17:12',
                'updated_at' => '2022-03-27 23:17:13',
            ],
            3 => [
                'id' => 4,
                'name' => 'Premium',
                'expedients' => 150,
                'users' => 10,
                'video_minutes' => '2000.00',
                'usd_month' => '300.00',
                'usd_year' => '3000.00',
                'usd_expedient' => '0.50',
                'usd_user' => '10.00',
                'stripe_id' => null,
                'created_at' => '2022-03-27 23:17:48',
                'updated_at' => '2022-03-27 23:17:48',
            ],
        ];
        foreach ($packages as &$package) {
            $product = $stripe->products->create([
                'name' => $package['name'],
            ]);
            $package['stripe_id'] = $product->id;
//            if (env('APP_ENV') == "local") {
            $stripe->prices->create([
                'unit_amount' => $package['usd_month'] * 100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'month'],
                'product' => $package['stripe_id'],
                'lookup_key' => $package['name'].' Monthly',
                'nickname' => $package['name'].' Monthly',
                'metadata' => [
                    'description' => $package['name'].' Monthly',
                ],
            ]);
            $stripe->prices->create([
                //                'unit_amount' => $package['usd_user'] * 100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'month',
                    'usage_type' => 'metered',
                ],
                'tiers_mode' => 'graduated',
                'billing_scheme' => 'tiered',
                'expand' => ['tiers'],
                'tiers' => [
                    [
                        'up_to' => $package['users'],
                        'unit_amount_decimal' => 0,
                    ],
                    [
                        'up_to' => 'inf',
                        'unit_amount_decimal' => $package['usd_user'] * 100,
                    ],
                ],

                'product' => $package['stripe_id'],
                'lookup_key' => $package['name'].' User Monthly',
                'nickname' => $package['name'].' User Monthly',
                'metadata' => [
                    'description' => $package['name'].' User Monthly',
                ],
            ]);

            $stripe->prices->create([
                //                'unit_amount' => $package['usd_expedient'] * 100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'month',
                    'usage_type' => 'metered',
                ],
                'tiers_mode' => 'graduated',
                'billing_scheme' => 'tiered',
                'expand' => ['tiers'],
                'tiers' => [
                    [
                        'up_to' => $package['expedients'],
                        'unit_amount_decimal' => 0,
                    ],
                    [
                        'up_to' => 'inf',
                        'unit_amount_decimal' => $package['usd_expedient'] * 100,
                    ],
                ],
                'product' => $package['stripe_id'],
                'lookup_key' => $package['name'].' Expedient Monthly',
                'nickname' => $package['name'].' Expedient Monthly',
                'metadata' => [
                    'description' => $package['name'].' Expedient Monthly',
                ],
            ]);

            $stripe->prices->create([
                'unit_amount' => $package['usd_year'] * 100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'year'],
                'product' => $package['stripe_id'],
                'lookup_key' => $package['name'].' Yearly',
                'nickname' => $package['name'].' Yearly',
                'metadata' => [
                    'description' => $package['name'].' Yearly',
                ],
            ]);
            $stripe->prices->create([
                //                'unit_amount' => $package['usd_user'] * 100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'year',
                    'usage_type' => 'metered',
                ],
                'tiers_mode' => 'graduated',
                'billing_scheme' => 'tiered',
                'expand' => ['tiers'],
                'tiers' => [
                    [
                        'up_to' => $package['users'],
                        'unit_amount_decimal' => 0,
                    ],
                    [
                        'up_to' => 'inf',
                        'unit_amount_decimal' => $package['usd_user'] * 100,
                    ],
                ],
                'product' => $package['stripe_id'],
                'lookup_key' => $package['name'].' User Yearly',
                'nickname' => $package['name'].' User Yearly',
                'metadata' => [
                    'description' => $package['name'].' User Yearly',
                ],

            ]);

            $stripe->prices->create([
                //                'unit_amount' => $package['usd_expedient'] * 100,
                'currency' => 'usd',
                'recurring' => ['interval' => 'year',
                    'usage_type' => 'metered',
                ],
                'tiers_mode' => 'graduated',
                'billing_scheme' => 'tiered',
                'expand' => ['tiers'],
                'tiers' => [
                    [
                        'up_to' => $package['expedients'],
                        'unit_amount_decimal' => 0,
                    ],
                    [
                        'up_to' => 'inf',
                        'unit_amount_decimal' => $package['usd_expedient'] * 100,
                    ],
                ],
                'product' => $package['stripe_id'],
                'lookup_key' => $package['name'].' Expedient Yearly',
                'nickname' => $package['name'].' Expedient Yearly',
                'metadata' => [
                    'description' => $package['name'].' Expedient Yearly',
                ],
            ]);

//            } else {
//                $stripe->prices->create([
//                    'unit_amount' => $package['usd_month'] * 100,
//                    'currency' => 'usd',
//                    'recurring' => ['interval' => 'month'],
//                    'product' => $package['stripe_id'],
//                    'lookup_key' => $package['name'] . " Monthly"
//                ]);
//                $stripe->prices->create([
//                    'unit_amount' => $package['usd_year'] * 100,
//                    'currency' => 'usd',
//                    'recurring' => ['interval' => 'year'],
//                    'product' => $package['stripe_id'],
//                    'lookup_key' => $package['name'] . " Yearly"
//                ]);
//            }
        }
        DB::table('packages')->insert($packages);
    }
}
