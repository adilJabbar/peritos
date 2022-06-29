<?php

namespace Database\Seeders;

use App\Models\Admin\Country;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provincias = [
            'A Coruña' => '0.991273282734010',
            'Alava' => '1.113902051957840',
            'Albacete' => '0.924854320597261',
            'Alicante' => '1.021934721776680',
            'Almeria' => '0.996386353732261',
            'Asturias' => '1.052596160819350',
            'Avila' => '0.929950404648674',
            'Badajoz' => '0.911570528169911',
            'Baleares' => '1.052596160819350',
            'Barcelona' => '1.134337349004010',
            'Burgos' => '0.955498772693091',
            'Caceres' => '0.911570528169911',
            'Cadiz' => '1.021934721776680',
            'Cantabria' => '1.057692244870760',
            'Castellon' => '1.021934721776680',
            'Ceuta' => '1.057692244870760',
            'Ciudad Real' => '0.919741249599010',
            'Cordoba' => '0.914628178600759',
            'Cuenca' => '0.919741249599010',
            'Girona' => '1.098579825909930',
            'Granada' => '0.940176546645176',
            'Guadalajara' => '0.940176546645176',
            'Guipuzcoa' => '1.113902051957840',
            'Huelva' => '1.001499424730510',
            'Huesca' => '1.011708579780180',
            'Jaen' => '0.914628178600759',
            'Las Palmas' => '1.062805315869010',
            'Leon' => '0.965724914689593',
            'Lleida' => '0.991273282734010',
            'Lugo' => '0.950402688641678',
            'Madrid' => '1.134337349004010',
            'Malaga' => '1.021934721776680',
            'Melilla' => '1.057692244870760',
            'Murcia' => '1.011708579780180',
            'Navarra' => '1.052596160819350',
            'Ourense' => '0.924854320597261',
            'Palencia' => '0.924854320597261',
            'Pontevedra' => '0.991273282734010',
            'Rioja' => '1.047483089821090',
            'Salamanca' => '0.929950404648674',
            'Segovia' => '0.940176546645176',
            'Sevilla' => '1.021934721776680',
            'Soria' => '0.924854320597261',
            'Tarragona' => '1.098579825909930',
            'Tenerife' => '1.062805315869010',
            'Teruel' => '0.919741249599010',
            'Toledo' => '0.955498772693091',
            'Valencia' => '1.021934721776680',
            'Valladolid' => '0.965724914689593',
            'Vizcaya' => '1.113902051957840',
            'Zamora' => '0.924854320597261',
            'Zaragoza' => '1.052596160819350',
        ];

        $country = Country::where('code', 'es')->first();
        foreach ($provincias as $key => $value) {
            $country->states()->updateOrCreate(['name' => $key], ['national_adjustment' => $value]);
        }

        $states = [
            'Alabama' => '1',
            'Alaska' => '1',
            'Arizona' => '1',
            'Arkansas' => '1',
            'California' => '1',
            'Colorado' => '1',
            'Connecticut' => '1',
            'Delaware' => '1',
            'Florida' => '1',
            'Georgia' => '1',
            'Hawaii' => '1',
            'Idaho' => '1',
            'Illinois' => '1',
            'Indiana' => '1',
            'Iowa' => '1',
            'Kansas' => '1',
            'Kentucky' => '1',
            'Louisiana' => '1',
            'Maine' => '1',
            'Maryland' => '1',
            'Massachusetts' => '1',
            'Michigan' => '1',
            'Minnesota' => '1',
            'Mississippi' => '1',
            'Missouri' => '1',
            'Montana' => '1',
            'Nebraska' => '1',
            'Nevada' => '1',
            'New Hampshire' => '1',
            'New Jersey' => '1',
            'New Mexico' => '1',
            'New York' => '1',
            'North Carolina' => '1',
            'North Dakota' => '1',
            'Ohio' => '1',
            'Oklahoma' => '1',
            'Oregon' => '1',
            'Pennsylvania' => '1',
            'Rhode Island' => '1',
            'South Carolina' => '1',
            'South Dakota' => '1',
            'Tennessee' => '1',
            'Texas' => '1',
            'Utah' => '1',
            'Vermont' => '1',
            'Virginia' => '1',
            'Washington' => '1',
            'West Virginia' => '1',
            'Wisconsin' => '1',
            'Wyoming' => '1',
        ];

        $country = Country::where('code', 'us')->first();
        foreach ($states as $key => $value) {
            $country->states()->updateOrCreate(['name' => $key], ['national_adjustment' => $value]);
        }
    }
}
