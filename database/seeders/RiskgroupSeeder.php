<?php

namespace Database\Seeders;

use App\Models\Admin\Riskgroup;
use Illuminate\Database\Seeder;

class RiskgroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $riskGroup = Riskgroup::updateOrCreate(['country_id' => 1, 'name' => 'Residencial']);

        $subgroup = $riskGroup->risksubgroups()->updateOrCreate(['name' => 'En altura']);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'En bloque aislado (menos de 16 viviendas)', ], [
                'national_modificator' => 1.112,
                'vpo_modificator' => 0.7519,
                'low_modificator' => 0.87595,
                'high_modificator' => 1.18795,
                'luxe_modificator' => 1.3759,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'En bloque aislado (16 a 40 viviendas)', ], [
                'national_modificator' => 1.0219,
                'vpo_modificator' => 0.7692,
                'low_modificator' => 0.8846,
                'high_modificator' => 1.19615,
                'luxe_modificator' => 1.3923,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'En bloque aislado (más de 40 viviendas)', ], [
                'national_modificator' => 0.9422,
                'vpo_modificator' => 0.7813,
                'low_modificator' => 0.89065,
                'high_modificator' => 1.19925,
                'luxe_modificator' => 1.3985,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'En manzana cerrada (menos de 16 viviendas)', ], [
                'national_modificator' => 1.032,
                'vpo_modificator' => 0.7813,
                'low_modificator' => 0.89065,
                'high_modificator' => 1.15625,
                'luxe_modificator' => 1.3125,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'En manzana cerrada (16 a 40 viviendas)', ], [
                'national_modificator' => 0.9549,
                'vpo_modificator' => 0.7936,
                'low_modificator' => 0.8968,
                'high_modificator' => 1.15475,
                'luxe_modificator' => 1.3095,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'En manzana cerrada (más de 40 viviendas)', ], [
                'national_modificator' => 0.8798,
                'vpo_modificator' => 0.8065,
                'low_modificator' => 0.90325,
                'high_modificator' => 1.1492,
                'luxe_modificator' => 1.2984,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'En manzana cerrada (más de 40 viviendas)', ], [
                'national_modificator' => 0.8798,
                'vpo_modificator' => 0.8065,
                'low_modificator' => 0.90325,
                'high_modificator' => 1.1492,
                'luxe_modificator' => 1.2984,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'Garaje en plurifamiliar', ], [
                'national_modificator' => 0.5118,
                'vpo_modificator' => 0.8696,
                'low_modificator' => 0.9348,
                'high_modificator' => 1.1,
                'luxe_modificator' => 1.2,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'Almacenes y trasteros en plurifamiliar', ], [
                'national_modificator' => 0.4597,
                'vpo_modificator' => 0.9524,
                'low_modificator' => 0.9762,
                'high_modificator' => 1.03335,
                'luxe_modificator' => 1.0667,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'Instalaciones y otros en plurifamiliar', ], [
                'national_modificator' => 0.4719,
                'vpo_modificator' => 0.9346,
                'low_modificator' => 0.9673,
                'high_modificator' => 1.0514,
                'luxe_modificator' => 1.1028,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'Oficinas en plurifamiliar, sin decoración ni instalaciones', ], [
                'national_modificator' => 0.7431,
                'vpo_modificator' => 0.7813,
                'low_modificator' => 0.89065,
                'high_modificator' => 1.1367,
                'luxe_modificator' => 1.2734,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'Locales en plurifamiliar, diáfanos en estructura, sin acabados', ], [
                'national_modificator' => 0.3627,
                'vpo_modificator' => 0.9091,
                'low_modificator' => 0.95455,
                'high_modificator' => 1.0682,
                'luxe_modificator' => 1.1364,
            ]);

        $subgroup = $riskGroup->risksubgroups()->updateOrCreate(['name' => 'Unifamiliares']);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'Aislada', ], [
                'national_modificator' => 1.6344,
                'vpo_modificator' => 0.6329,
                'low_modificator' => 0.81645,
                'high_modificator' => 1.24685,
                'luxe_modificator' => 1.4937,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'En hilera (menos de 10 viviendas)', ], [
                'national_modificator' => 1.3239,
                'vpo_modificator' => 0.6711,
                'low_modificator' => 0.83555,
                'high_modificator' => 1.23825,
                'luxe_modificator' => 1.4765,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'En hilera (10 a 25 viviendas)', ], [
                'national_modificator' => 1.2601,
                'vpo_modificator' => 0.6757,
                'low_modificator' => 0.83785,
                'high_modificator' => 1.2365,
                'luxe_modificator' => 1.473,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'En hilera (más de 25 viviendas)', ], [
                'national_modificator' => 1.1889,
                'vpo_modificator' => 0.6849,
                'low_modificator' => 0.84245,
                'high_modificator' => 1.2363,
                'luxe_modificator' => 1.4726,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'Garaje en unifamiliar', ], [
                'national_modificator' => 0.6179,
                'vpo_modificator' => 0.8065,
                'low_modificator' => 0.90325,
                'high_modificator' => 1.2285,
                'luxe_modificator' => 1.4516,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'Almacenes y trasteros en unifamiliar', ], [
                'national_modificator' => 0.547,
                'vpo_modificator' => 0.8475,
                'low_modificator' => 0.92375,
                'high_modificator' => 1.1907,
                'luxe_modificator' => 1.3814,
            ]);
        $subgroup->riskDetails()->updateOrCreate([
            'description' => 'Instalaciones y otros en unifamiliar', ], [
                'national_modificator' => 0.5277,
                'vpo_modificator' => 0.9091,
                'low_modificator' => 0.95455,
                'high_modificator' => 1.17275,
                'luxe_modificator' => 1.3455,
            ]);
//
//        $subgroup = $riskGroup->risksubgroups()->updateOrCreate(['name' => 'Comercios']);
//
//        $subgroup = $riskGroup->risksubgroups()->updateOrCreate(['name' => 'Deportivos']);
//
//        Riskgroup::updateOrCreate(['country_id' => 1, 'name' => 'No Residencial']);
    }
}
