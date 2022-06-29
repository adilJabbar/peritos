<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuaranteesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('guarantees')->delete();

        DB::table('guarantees')->insert([
            0 => [
                'id' => 5,
                'name' => 'Incendio',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => '<ul><li>Los daños producidos como consecuencia de almacenar materiales peligrosos no habituales en un domicilio particular.</li><li>El objeto en contacto con aparatos de calefacción, fuego, chimeneas, hogares o aparatos de alumbrado.</li><li>Los daños en los objetos caídos accidentalmente a aparatos de calefacción, fuego, chimeneas, hogares o aparatos de alumbrado.</li><li>Los accidentes de fumador.</li></ul>',
                'created_at' => '2021-11-18 20:20:56',
                'updated_at' => '2021-11-18 21:30:14',
            ],
            1 => [
                'id' => 6,
                'name' => 'Explosión y Caida de Rayo',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => '<ul><li>Los daños producidos como consecuencia de almacenar materiales peligrosos no habituales en un domicilio particular.</li><li>El objeto en contacto con aparatos de calefacción, fuego, chimeneas, hogares o aparatos de alumbrado.</li><li>Los daños en los objetos caídos accidentalmente a aparatos de calefacción, fuego, chimeneas, hogares o aparatos de alumbrado.</li><li>Los accidentes de fumador.</li></ul>',
                'created_at' => '2021-11-18 20:21:02',
                'updated_at' => '2021-11-18 21:30:11',
            ],
            2 => [
                'id' => 7,
                'name' => 'Fenómenos Atmosféricos',
                'product_id' => 4,
                'notes' => '<div>La medición de los fenómenos atmosféricos de lluvia y viento se acreditará fundamentalmente con los informes expedidos por los Organismos Oficiales competentes o, en su defecto, mediante aportación de otras pruebas que acrediten el fenómeno que ha producido el daño y puedan ser evaluadas técnicamente.</div>',
                'exclusions' => '<ul><li>Los daños ocasionados por oxidaciones o humedades, así como por nieve, agua, arena o polvo que penetre por puertas, ventanas u otras aberturas que hayan quedado sin cerrar, así como daños que por estas causas se produzcan en los bienes depositados al aire libre o en el interior de construcciones abiertas.</li><li>Los daños causados por heladas, frío, hielo, olas o mareas, incluso cuando estos fenómenos hayan sido causados por el viento.</li><li>Los daños causados por vientos extraordinarios, definidos los mismos cuando presenten rachas que superen los 135 kilómetros por hora.&nbsp;</li><li>Los hechos o fenómenos que correspondan a riesgos amparados por el Consorcio de Compensación de Seguros, que son los que se describen en el presente contrato.</li><li>Los daños estéticos producidos en el exterior de la construcción asegurada por agua, arena o barro.</li></ul>',
                'created_at' => '2021-11-18 20:21:55',
                'updated_at' => '2021-11-18 21:33:21',
            ],
            3 => [
                'id' => 8,
                'name' => 'Daños Diversos',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => '',
                'created_at' => '2021-11-18 20:25:30',
                'updated_at' => '2021-11-18 21:36:28',
            ],
            4 => [
                'id' => 9,
                'name' => 'Daños por Agua',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => '<ul><li>Los daños que tengan su origen en las conducciones correspondientes a la Comunidad de Propietarios o a canalizaciones públicas.</li><li>Los daños que tengan su origen en la omisión de las reparaciones indispensables para el normal estado de conservación de las instalaciones o para subsanar el desgaste de conducciones y aparatos, incluidos los daños por corrosión. No obstante, en los casos en los que el Asegurado no haya podido tener conocimiento de este mal estado, por tratarse de instalaciones empotradas u ocultas MM Hogar tomará a su cargo el primer siniestro declarado en tales circunstancias, aunque limitando el coste máximo de reparación de la avería causante a 400 euros. Si se producen siniestros posteriores sin haberse adoptado las reparaciones o reformas oportunas, se considerará que el Asegurado ha incurrido en culpa grave y por consiguiente en aplicación a lo previsto en esta misma póliza (exclusiones generales), MM Hogar quedará liberada de su responsabilidad por lo que a esta cobertura de daños por agua se refiere y suspendidas las garantías de la misma hasta que el Asegurado no realice las obras de remodelación que sean precisas.&nbsp;</li><li>Los daños provocados por la entrada o filtraciones de agua del exterior a consecuencia de fenómenos meteorológicos a través de aberturas, tales como ventanas, balcones, puertas, etc., así como por las aguas que discurran por jardines o jardineras, vías públicas o privadas.</li><li>Los daños producidos por humedad, lluvia o condensaciones.</li><li>Los daños resultantes de tempestades, huracanes, inundaciones, mareas y desbordamientos de fuentes, ríos, lagos y presas.</li><li>Los daños que tengan su origen en fosas sépticas, cloacas, alcantarillas, arquetas, o canalizaciones subterráneas de suministro o de desagüe de agua, siempre que éstas últimas estén situadas fuera de la vertical de la cubierta del edificio, o no sirvan en exclusividad a la vivienda asegurada, sus atascos, así como los daños debidos a deslizamientos, hundimientos, reblandecimiento del terreno y corrimientos de tierra.&nbsp;</li><li>Los producidos como consecuencia de trabajos de construcción o reparación de la vivienda asegurada o del edificio.</li><li>La reparación de grifería, aparatos electrodomésticos o depósitos cuando sean causantes del siniestro.</li><li>Los gastos de desatascos, localización o reparación de averías que no produzcan daños indemnizables por esta garantía.</li></ul>',
                'created_at' => '2021-11-18 20:26:49',
                'updated_at' => '2021-11-18 21:42:15',
            ],
            5 => [
                'id' => 10,
                'name' => 'Daños Eléctricos',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:28:12',
                'updated_at' => '2021-11-18 20:28:12',
            ],
            6 => [
                'id' => 11,
                'name' => 'Daños Estéticos',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:28:53',
                'updated_at' => '2021-11-18 20:28:53',
            ],
            7 => [
                'id' => 12,
                'name' => 'Inhabitabilidad y Pérdida de Alquileres',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:29:43',
                'updated_at' => '2021-11-18 20:29:43',
            ],
            8 => [
                'id' => 13,
                'name' => 'Reconstrucción de Documentos',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:30:35',
                'updated_at' => '2021-11-18 20:30:35',
            ],
            13 => [
                'id' => 14,
                'name' => 'Alientos en Frigoríficos',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:30:56',
                'updated_at' => '2021-11-18 20:30:56',
            ],
            14 => [
                'id' => 15,
                'name' => 'Rotura lunas',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:31:36',
                'updated_at' => '2021-11-18 20:31:36',
            ],
            15 => [
                'id' => 16,
                'name' => 'Robo y expoliación',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:32:40',
                'updated_at' => '2021-11-18 20:32:40',
            ],
            16 => [
                'id' => 17,
                'name' => 'Fuera del hogar',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:33:39',
                'updated_at' => '2021-11-18 20:33:39',
            ],
            17 => [
                'id' => 18,
                'name' => 'Reposición de llaves y cerraduras',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:34:30',
                'updated_at' => '2021-11-18 20:34:30',
            ],
            18 => [
                'id' => 19,
                'name' => 'Responsabilidad Civil',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:34:56',
                'updated_at' => '2021-11-18 20:34:56',
            ],
            19 => [
                'id' => 20,
                'name' => 'Defensa Jurídica',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:38:10',
                'updated_at' => '2021-11-18 20:38:10',
            ],
            20 => [
                'id' => 21,
                'name' => 'Asistencia en el Hogar',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:38:44',
                'updated_at' => '2021-11-18 20:38:44',
            ],
            21 => [
                'id' => 22,
                'name' => 'Joyas',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:40:34',
                'updated_at' => '2021-11-18 20:40:34',
            ],
            22 => [
                'id' => 23,
                'name' => 'Objetos de Valor Especial',
                'product_id' => 4,
                'notes' => null,
                'exclusions' => null,
                'created_at' => '2021-11-18 20:41:01',
                'updated_at' => '2021-11-18 20:41:01',
            ],
        ]);
    }
}
