<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TextPreexistencesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('text_preexistences')->delete();

        DB::table('text_preexistences')->insert([
            0 => [
                'id' => 1,
                'expedient_id' => 1,
                'risk_description' => '<div>El riesgo asegurado es una nave industrial dedicada a la importación, almacenamiento y distribución de productos congelados orientales, y se encuentra situado en un polígono industrial vallado y con dos accesos abiertos durante el día y controlados por personal de seguridad por las noches. De acuerdo con el catastro la superficie total es de 509 m², repartidos entre 393 m² de nave y 116 m² de elementos comunes del polígono., cubierta metálica y fachada enfoscada. Cuenta con dos únicos accesos desde el exterior, uno peatonal con una puerta de dos hojas y otro para la entrada de camiones a la zona de carga y descarga con una puerta basculante. Además de las puertas, los únicos puntos de acceso al interior son ventanas que se encuentran situadas a más de 5 m de altura.</div>',
                'risk_matches' => 'Las medidas de seguridad declaradas en la póliza no corresponden exactamente con el riesgo. En cuanto a las puertas se indica que existen "Cierre Ciego O Cristal Antirrobo (3 capas de 6 mm)", mientras que se trata de una puerta metálica y acristalada, protegida con barrotes metálicos, pero no existe cierre alguno. Con respecto a la vigilancia común al polígono, la misma está limitada a horarios nocturnos entre diario, y en jornada vespertina y nocturna en fines de semana. Cuenta el riesgo con una alarma que cubre todos los huecos de acceso a la nave, siendo estos la puerta basculante de mercancías, y la puerta peatonal, encontrándose las ventanas de la primera planta a más de 3 metros del suelo. En cualquier caso existen detectores volumétricos en la planta primera que es donde se encuentra la centralita, por lo que que se trata de una alarma autoprotegida por volumétricos, con batería según las especificaciones y con conexión a central receptora de empresa de seguridad. Lo único que no dispone la alarma es de un señalizador acústico/óptico en el exterior del local.',
                'created_at' => '2021-11-11 18:11:40',
                'updated_at' => '2021-11-11 18:40:20',
            ],
        ]);
    }
}
