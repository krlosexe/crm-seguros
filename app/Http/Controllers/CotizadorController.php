<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CotizadorController extends Controller
{

    private $apimovilidad = '';

    private $apikeymovilidad = ['x-apikey:C4TW3yj6AyqbyUsAi1HiGniou8lY01yw'];

    function __construct(){
        
        $this->apimovilidad = 'https://apisura.segurossura.com/apimovilidad/v1/';

    }

    /*
    * Apimovilidad
    * Método que consulta la información complementaria que sirve para cotizar
    */
    function getMovilidadNodosMaestros(){

        $urlapi = $this->apimovilidad.'tiposdocumento';

        $result = $this->execApi($urlapi, array(), $this->apikeymovilidad);

    }

    private function execApi($api = '', $payload = array(), $headers = array()){
        $ch = curl_init($api);

        $payload = json_encode($payload);

        // array_push($headers, 'Content-Type:application/json');

        // Data
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // cabeceras
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // retornar respuesta
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

        dd($info);
    }
}
