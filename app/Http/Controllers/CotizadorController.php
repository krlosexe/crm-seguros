<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CotizadorController extends Controller
{

    private $apisura = '';

    private $apikeysura = ['x-apikey' => 'C4TW3yj6AyqbyUsAi1HiGniou8lY01yw'];

    function __construct(){
        
        $this->apisura = 'https://apisuratest.segurossura.com/apimovilidad/v1/';

    }

    /*
    * apisura
    * Método que consulta la información complementaria que sirve para cotizar
    */

    // Acá van servicios que no dependen de la información de otros endpoints

    public function getSuraNodosMaestros(Request $request, $case){

        $client = $this->initConfigApiSura();
        
        switch ($case) {
            case 'tiposdocumento':
                
                $data = $this->getResult( $client->get('tiposdocumento') );
                    
                $data = array_filter($data, function($item){
                    return $item->codigoPais == 57;
                });

            break;
            case 'genero':
                
                $data = $this->getResult( $client->get('genero') );
                
            break;
            case 'estadocivil':
                
                $data = $this->getResult( $client->get('estadocivil') );
                
            break;
            case 'tipospersona':
                
                $data = $this->getResult( $client->get('tipospersona') );
                
            break;
            case 'tiposdireccion':
                
                $data = $this->getResult( $client->get('tiposdireccion') );
                
            break;
            case 'ocupaciones':
                
                $data = $this->getResult( $client->get('ocupaciones') );
                
            break;
            case 'ciudades':
                
                $data = $this->getResult( $client->get('prospectos/ciudades?codigoPais=57') );
                
            break;
            case 'clasesvehiculo':
                
                $data = $this->getResult( $client->get('clasesvehiculo') );
                
            break;
            case 'tiposservicio':
                
                $data = $this->getResult( $client->get('tiposservicio') );
                
            break;
            case 'usosvehiculo':
                
                $data = $this->getResult( $client->get('usosvehiculo') );
                
            break;
            case 'dispositivosseguridad':
                
                $data = $this->getResult( $client->get('dispositivosseguridad') );
                
            break;
            

                
        }


        return response()->json($data);
    }

    public function getPlacaSura(Request $request, $placa){

        $client = $this->initConfigApiSura();

        try {
            
            $data = $this->getResult( $client->get('vehiculo/placa/'.$placa) );
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            return response()->json(['mensaje' => 'No se encontró la placa: '.$placa], 404);

        }

        return response()->json($data);

    }

    private function initConfigApiSura(){

        return new \GuzzleHttp\Client([
            'base_uri' => $this->apisura,
            'headers' => $this->apikeysura,
            'debug' => false,
        ]); 
    }

    private function getResult($requestComplete){
        return json_decode( (String) $requestComplete->getBody());
    }


}
