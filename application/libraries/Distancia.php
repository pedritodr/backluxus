<?php

/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 20/3/2017
 * Time: 9:22
 */
class Distancia
{

    private $pto1;
    private $pto2;
    private $radio_tierra;

    public function __construct($ppto1,$ppto2)
    {
        $this->pto1 = $ppto1;
        $this->pto2 = $ppto2;
        $this->radio_tierra = 6378; //distancia en km del radio de la tierra ecuatorial
    }

    
    private function en_radianes($valor){
        return (float)((pi()/180)*$valor);
    }

    private function cuadrado($valor){
        return pow($valor,2);
    }

    public function calcular_distancia_km(){
        //Distancia en kilometros en 1 grado distancia.
        //Distancia en millas nauticas en 1 grado distancia: $mn = 60.098;
        //Distancia en millas en 1 grado distancia: 69.174;
        //Solo aplicable a la tierra, es decir es una constante que cambiaria en la luna, marte... etc.
        $km = 111.302;

        //1 Grado = 0.01745329 Radianes
        $degtorad = 0.01745329;

        //1 Radian = 57.29577951 Grados
        $radtodeg = 57.29577951;
        //La formula que calcula la distancia en grados en una esfera, llamada formula de Harvestine. Para mas informacion hay que mirar en Wikipedia
        //http://es.wikipedia.org/wiki/F%C3%B3rmula_del_Haversine
        $dlong = ($this->pto1->getLongitud() - $this->pto2->getLongitud());
        $dvalue = (sin($this->pto1->getLatitud() * $degtorad) * sin($this->pto2->getLatitud() * $degtorad)) + (cos($this->pto1->getLatitud() * $degtorad) * cos($this->pto2->getLatitud() * $degtorad) * cos($dlong * $degtorad));
        $dd = acos($dvalue) * $radtodeg;
        return round(($dd * $km), 2);

    }

    public function get_fronteras($center,$radio_km){ // recibe objeto Punto, y valor double punto flotante
        //retorna [Punto Norte, Punto Este, Punto Sur, Punto Oeste]

        //trabajar la latitud
        $earth = 6378.137;  //radius of the earth in kilometer
        $pi = pi();
        $m = (1 / ((2 * $pi / 360) * $earth)) / 1000;  //1 meter in degree

        $norte = $center->getLatitud() - ($radio_km * $m);
        $sur = $center->getLatitud() + ($radio_km * $m);


        //trabajar con la longitud
        $earth_l = 6378.137;  //radius of the earth in kilometer
        $pi_l = pi();
       
        $m_l = (1 / ((2 * $pi_l / 360) * $earth_l)) / 1000;  //1 meter in degree

        $west = $center->getLongitud() - ($radio_km * $m_l) / cos($center->getLongitud() * ($pi_l / 180));
        $east = $center->getLongitud() + ($radio_km * $m_l) / cos($center->getLongitud() * ($pi_l / 180));

        return [$norte,$east,$sur,$west];

    }



}

class Punto {
    private $lat;
    private $lng;
    public function __construct($plat,$plng)
    {
       $this->lat = $plat;
       $this->lng = $plng;
    }

    public function getLatitud(){
        return (double)$this->lat;
    }

    public function getLongitud(){
        return (double)$this->lng;
    }
}