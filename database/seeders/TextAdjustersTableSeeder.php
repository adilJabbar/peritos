<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TextAdjustersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('text_adjusters')->delete();

        DB::table('text_adjusters')->insert([
            0 => [
                'id' => 1,
                'expedient_id' => 1,
                'attended_by' => 'Asegurado',
                'chronology' => '<div>El siniestro se produce entre los días 27 y 28 de Septiembre de 2.012, cuando unos intrusos acceden al interior de la nave tras forzar la puerta de acceso peatonal, mediante un apalancamiento realizado en la zona de la cerradura, causando daños tanto en ambas hojas, en diferentes puntos. Una vez en el interior del inmueble, los ladrones sabotearon la central de alarma que se encuentra en el despacho de la planta situado en la planta +1, y cuya conexión con la central receptora se realiza por cableado telefónico. Por lo tanto, una vez cortado el cable, la alarma se quedó sin posibilidad de conexión. Posteriormente abrieron un mueble del despacho y se llevaron consigo el ordenador que se encuentra conectado a un sistema de vigilancia propio del asegurado, y que registra imágenes de cuatro cámaras distribuidas por el interior del recinto, y una de ellas en la calle dando cobertura a la entrada. Este equipo no tenía conexión a ningún servidor al que replicase las imágenes capturadas, por lo que los ladrones se han llevado consigo el soporte digital que contiene dichas grabaciones, es decir, los discos duros montados en el interior de la CPU que se han llevado.</div>',
                'adjuster' => '<div>Según hemos indicado anteriormente, el recinto del polígono industrial se encuentra cerrado y cuenta con dos accesos, protegidos por cámaras de seguridad y con vigilancia durante las 12 horas de la noche, encontrándose abierto al tránsito el resto del día.&nbsp;<br>En cualquier caso, como ya hemos indicado, se trata de un polígono industrial abierto durante el día, en el cual existe un&nbsp;</div><div>tráfico continuado de camiones, y lo que si nos certifica el vigilante es que durante las horas de noche en que ellos se encontraban en las instalaciones no entró ni salió vehículo alguno que pudiera haber transportado los objetos robados, ya que tienen instrucciones de seguir a cada vehículo que entra en el recinto en horario no habitual, y no tiene constancia de ninguna anomalía en este sentido.&nbsp;</div><div>&nbsp;</div><div>En cuanto al género robado, el día anterior al siniestro el asegurado acababa de recibir el contenedor que recibe con una cadencia aproximadamente mensual con género, por lo que tenía el almacén prácticamente lleno. En relación a la mercancía sustraída, para la elaboración de este informe se han realizado dos comprobaciones diferentes basadas en la documentación que el asegurado nos ha facilitado acorde con lo que le ha sido solicitado. En primer lugar se ha intentado verificar que el género que los ladrones se han llevado consigo ha estado en algún momento anterior al siniestro en el interior del riesgo, con el fin de acreditar la preexistencia del mismo. En segundo lugar se han realizado cálculos cuantitativos respecto al volumen y peso del género robado, con el fin de intentar determinar el modo en que los ladrones se llevaron la mercancía.</div><div>&nbsp;&nbsp;</div><div><strong>RESTO DE DOCUMENTACIÓN ANALIZADA</strong></div><div>&nbsp;</div><div>Adjuntamos a este expediente copia del impuesto de sociedades presentado por el asegurado y correspondiente al año 2.011, en el cual comprobamos que el volumen de negocio de la empresa asciende a 652.417,66 €. Consideramos que esta cifra tiene consonancia con la mercancía declarada como robada, ya que la partida de mayor importe del género robado se corresponde con producto entregado en marzo de 2.011.</div><div>&nbsp;</div><div>También adjuntamos copia de la revisión realizada por los técnicos de la alarma, así como factura de compra del ordenador robado y presupuesto de reparación de la puerta, considerando este último excesivo y realizando por lo tanto la valoración de acuerdo con nuestro criterio profesional.</div><div>&nbsp;</div><div>Recibido y analizado el informe de la central de alarmas, verificamos que la empresa emisora certifica que en el momento del robo la alarma se encontraba conectada, puesto que la misma se conectó el 27/09/2012 a las 20:20, siendo supuestamente saboteada con suficiente rapidez por parte de los ladrones como para que no le diera tiempo a comunicar con la central receptora. En cualquier caso, en dicho informe se hace mención a que la alarma se conectó a las 20:20, pero no figura que en la memoria de la centralita existiese registrado ningún salto que no pudiese llegar a transmitir a la central, a pesar del sabotaje.</div>',
                'damages' => '<div><strong>1.- COMPROBACIÓN DE PREEXISTENCIAS:</strong></div><div>&nbsp;</div><div>El asegurado nos ha facilitado una relación del género robado, así como una relación informatizada del género existente en el riesgo en el momento del robo. Además, nos ha facilitado copias de las facturas de compra del género, así como de los despachos de aduana y los costes de transporte de la mercancía. Con el fin de verificar cuantitativamente que todo el género declarado como robado podría encontrarse en las instalaciones en el momento del robo, hemos realizado una segunda visita el día 26/10/12, en la cual hemos comprobado como queda configurada la cámara frigorífica después de recibir un nuevo container. En esta segunda visita hemos verificado que es factible que en el momento del robo se encontrase en el interior de la cámara el género declarado como robado.</div><div>&nbsp;</div><div>En cuanto a la preexistencia del género, hemos agrupado los diferentes documentos que nos ha facilitado el asegurado, clasíficándolos de la A a la N. Posteriormente hemos analizado cada partida declarada como robada verificando la existencia de un documento que justificase su preexistencia, y calculando el coste real de la misma mediante la aplicación prorrateada de los costes de transporte que nos han sido justificados. Adjuntamos al informe un documento que resume el análisis realizado, y en el cual se referencia en que documento se encuentra cada una de las partidas con el fin de facilitar su localización. De este análisis se obtiene que los costes totales de la mercancía robada son sensíblemente inferiores al valor declarado por el asegurado, por lo que le hemos pedido que nos aclare el motivo de estas diferencias. Ante dicha solicitud de aclaración nos confirma que para el cálculo de coste de producto incrementan un porcentaje estimado (margen comercial) que aplican a cada uno de ellos, si bien nuestros cálculos se basan en datos exactos. En los resultados finales no se ha tenido en cuenta el IVA correspondiente.</div><div>&nbsp;</div><div>Además, existen cinco productos de la relación de mercancía robada, de los cuales la cantidad justificada como preexistencia es inferior a la declarada como robada, además de otros tres de los cuales se ha aportado documentos fechados en diciembre de 2.010 como justificantes de preexistencia.</div><div>&nbsp;</div><div><strong>2.- CUANTIFICACIÓN DEL GÉNERO ROBADO:</strong></div><div>&nbsp;</div><div>Una vez realizados los cálculos correspondientes al género que ha sido declarado como robado, en el momento de totalizar la mercancía comprobamos que el peso total de la misma asciende a 19.940,68 Kg, sin tener en cuenta los embalajes ni la paletización. Si tenemos en cuenta que la carga máxima para un container de 20 pies es de 21.750 Kg, esto supone que la mercancía robada supone prácticamente la totalidad de carga admisible para un container de 5,90 m de largo x 2,352 m de ancho y 2,392 m de alto. Hay que tener en cuenta que alcanzar las cargas máximas y el aprovechamiento correcto del espacio no son compatibles con la hipotética presión a la que uno se ve sometido cuando está cometiendo un acto delictivo.</div><div>Adjuntamos copia del albarán de entrega en el que venía gran parte del género robado. Según este documento el container era de 40 pies y tenía un peso de 24.000 Kg. Por lo tanto, el género robado equivale prácticamente al 83% del género que transportaba un contenedor de 40 pies.</div>',
                'evaluations' => '<div>Incluimos por lo tanto en nuestra valoración los daños sufridos en el continente, tanto la reparación provisional de emergencia realizada por Asistencia, como la reparación definitiva de la puerta forzada. También incluimos en nuestra valoración el equipo informático robado y el dinero en efectivo, este último como excluido dado que no existen daños en ningún mueble que certifiquen que se encontraba en el interior de un mueble cerrado, según exige el condicionado general de la póliza.</div><div>&nbsp;</div><div>Existe en los capitales contratados para mercancías infraseguro. Sin embargo, dado que el capital contratado se encuentra en la modalidad de Existencias promedio, y puesto que de acuerdo con el condicionado esto supone el incremento de un 50% de dicho capital en el supuesto de que se produzca un siniestro, el resultado final supondría un total de 405.000,00 €, siendo el valor de las existencias en el momento del robo de 347.000,00. Por lo tanto no consideramos de aplicación la regla proporcional.</div><div>&nbsp;</div><div>En cuanto a la mercancía robada, la incluimos en nuestra tasación de acuerdo con los cálculos desprendidos de nuestros análisis, ascendiendo a un total de 68.326,20 €, en vez de los 98.825,73 € reclamados por el asegurado. Esta valoración la realizamos como excluida ya que de acuerdo con las descripciones de la póliza respecto del sistema de alarma, esta debe contar con un señalador acústico/óptico en el exterior del local, no cumpliendo con este requisito la instalación existente en el riesgo asegurado. Además, en las condiciones particulares de la póliza no se recoge que se trate de un almacén de mercancías sin personal, mientras que por la actividad que desarrollan hay bastantes periodos de tiempo que no se corresponden con la recepción de mercancía o la carga de los camiones de distribución, en los que la nave se encuentra totalmente desocupada, como ocurrió en el momento del robo a pesar de tratarse de horario correspondiente a una jornada laboral normal.</div>',
                'coverage' => '<div>De acuerdo con todo lo expuesto en este informe, consideramos que para la comisión del robo debería haber participado más de un vehículo, ya que de haber intervenido un único vehículo debería haber sido de muy grandes dimensiones, lo cual limita notablemente su maniobrabilidad y entendemos que habría supuesto mayores dificultades para pasar desapercibido.</div><div>&nbsp;</div><div>En cuanto a la cuantificación del género robado, consideramos que supone un hecho cuestionable que se pueda realizar en un breve espacio de tiempo y sin que nadie aprecie nada extraño, a pesar de que este hecho coincida con fenómenos meteorológicos adversos.</div><div>&nbsp;</div><div>En cuanto a la ausencia del asegurado el día del robo, el propio asegurado nos ha confirmado que de ser posible gran parte del género que se descarga cuando llega un contenedor, se carga esa misma noche en los camiones frigoríficos que lo distribuyen por la costa oriental española. De ser así por la mañana no hay nadie, como ha ocurrido en el caso del contenedor entregado en octubre. Sin embargo, la práctica más habitual es que los pedidos para entregar se preparen y carguen el día siguiente a la entrega del contenedor.</div><div>&nbsp;</div><div>Estamos en disposición de cerrar el expediente con la información de que disponemos a día de hoy, y en base a la cual no existe evidencia en que basarnos para no determinar como veraz lo declarado por el asegurado. En esta hipótesis nuestra tasación de daños por robo de contenido alcanzaría 68.890,00 €</div>',
                'created_at' => '2021-11-11 18:36:09',
                'updated_at' => '2021-11-11 18:47:02',
            ],
        ]);
    }
}
