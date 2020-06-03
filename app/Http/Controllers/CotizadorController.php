<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fasecolda;
use App\Vehicle;

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
            case 'ciudadescirculacion':
                
                $data = $this->getResult( $client->get('ciudadescirculacion') );
                
            break;
            case 'financiacionCompanias':
                
                $data = $this->getResult( $client->get('financiacion/companiasfinancieras') );
                
            break;
            case 'financiacionTiposcuenta':
                
                $data = $this->getResult( $client->get('financiacion/tiposcuenta') );
                
            break;
            case 'financiacionBancos':
                
                $data = $this->getResult( $client->get('financiacion/bancos') );
                
            break;
            case 'concesiorios':
                
                $client = $this->initConfigApiSura('https://apisuratest.segurossura.com/');

                $data = $this->getResult( $client->get('apigateway-ayv-autos/ohs-autos/concesiorios') );
                
            break;


        }

        return response()->json($data);
    }

    public function getPlacaSura(Request $request, $placa){

        $client = $this->initConfigApiSura();

        try {
            
            $data = $this->getResult( $client->get('vehiculo/placa/'.$placa) );
            $data->fasecoldaInfo = Fasecolda::where('codigo', $data->fasecolda)->first();
            $data->vehiculoInfo = Vehicle::where('placa', $placa)->first();
            $data->encontrado = true;

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            return response()->json([
                'mensaje' => 'No se encontró la placa: '.$placa, 
                'encontrado' => false,
                'vehiculoInfo' => Vehicle::where('placa', $placa)->first()
            ]);

        }

        return response()->json($data);
    }

    public function getPlanesFiltrados(Request $request, $codigoclasevehiculo, $tiposservicio){

        $client = $this->initConfigApiSura();

        try {
            
            $data = $this->getResult( $client->get('planesFiltrados/codigoclasevehiculo/'.$codigoclasevehiculo.'/tiposervicio/'.$tiposservicio.'/planes') );
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            return response()->json([], 404);

        }

        return response()->json($data);
    }

    public function getFasecoldaMarcas(Request $request, $codigoclasevehiculo, $modelovehiculo){

        $client = $this->initConfigApiSura();

        try {
            
            $data = $this->getResult( $client->get('fasecolda/marcas/'.$codigoclasevehiculo.'/modelo/'.$modelovehiculo.'/marcas') );
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            return response()->json([], 404);

        }

        return response()->json($data);
    }

    public function getFasecoldaLineas(Request $request, $params){
        $data = json_decode($params, true);

        $client = $this->initConfigApiSura();

        try {
            $data = $this->getResult( 
                $client->get('fasecolda/lineas/lineas-por-modelo-clase-marca?codigomodelo='.$data['codigomodelo'].'&codigoclase='.$data['codigoclase'].'&codigomarca='.$data['codigomarca'].'&dsmarca='.$data['dsmarca'].'&fechaAlta='.$data['fechaAlta']) 
            );
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            return response()->json([], 404);

        }

        return response()->json($data);
    }

    public function getFasecoldaModelo(Request $request, $params){
        $data = json_decode($params, true);

        $client = $this->initConfigApiSura();

        try {
            $data = $this->getResult( 
                $client->get('fasecolda/lineas/lineas-por-codigofasecolda-modelo?modelo='.$data['modelo'].'&fechaAlta='.$data['fechaAlta'].'&esmanual='.$data['esmanual'].'&codigofasecolda='.$data['codigofasecolda']) 
            );
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            return response()->json([], 404);

        }

        return response()->json($data);
    }

    public function getCoberturas(Request $request, $params){
        $data = json_decode($params, true);

        $client = $this->initConfigApiSura();

        try {
            $data = $this->getResult( 
                $client->get('coberturas/plan/'.$data['codigoplan'].'/clase/'.$data['codigoclasevehiculo'].'/ciudad/'.$data['codigociudad'].'/modelo/'.$data['modelovehiculo'].'/feini/'.$data['feinivigencia']
                    .'?canal='.$data['canal'].'&organizacion='.$data['organizacion']) 
            );
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            return response()->json([], 404);

        }

        return response()->json($data);
    }

    public function inspeccion(Request $request){
        
        $client = $this->initConfigApiSura();

            $req = $request->all();

            $req['coberturas'] = json_decode($req['coberturas']);

        try {

            $data = $this->getResult( 
                $client->request('POST', 'inspeccion', [
                       'headers' => [
                           'Content-Type' => 'application/json',
                       ],                       
                       'json' => $req,
                ])
            );
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {

            return response()->json([
              [
                "tipo" => "Tecnico",
                "mensaje" => "coberturas debe ser un arreglo"
              ]
            ], 404);

        }

        return response()->json($data);
    }

    public function sarlaft(Request $request){
        
        $client = $this->initConfigApiSura();

        try {

            $data = $this->getResult( 
                $client->post('sarlaft', [
                       'headers' => [
                           'Content-Type' => 'application/json',
                       ],                       
                       'json' => $request->all(),
                ])
            );
            
        } catch (\GuzzleHttp\Exception\ClientException $e) {

            return response()->json([
                  [
                    "tipo" => "Tecnico",
                    "mensaje" => " debe ser un arreglo"
                  ]
            ], 404);

        }

        return response()->json($data);
    }


    private function initConfigApiSura($newurl = ''){

        return new \GuzzleHttp\Client([
            'base_uri' => $newurl == ''? $this->apisura : $newurl,
            'headers' => $this->apikeysura,
            'debug' => false,
        ]); 
    }

    private function getResult($requestComplete){
        return json_decode( (String) $requestComplete->getBody());
    }


}
