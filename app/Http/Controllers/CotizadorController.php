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
                'clase' => '',
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

    public function cotizar(Request $request){
        
        $client = $this->initConfigApiSura();
        $req = $request->all();

        try {
            $data = $this->getResult( 
                $client->request('POST', 'individual/cotizacion', [
                       'headers' => [
                           'Content-Type' => 'application/json',
                       ],                       
                       'json' => $req,
                ])
            );
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            
            // echo json_encode($req);die;

            return response()->json([
              []
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
                    "requiereInspeccion" => false,
                    "placa" => $request->placa
                  ]
            ], 404);

        }

        return response()->json($data);
    }

    // Método va hacer todo el proceso de cotizar planes automaticamente

    public function cotizarPlanes(Request $request){
        set_time_limit(800);
        extract($request->all());

        $respuestas = array();

        // list planes
        $planes = $this->getPlanesFiltrados($request, $dataSelected['clasevehiculo'], $dataSelected['tiposservicio'])->getData();

        foreach ($planes as $plan) {
            $resp = $this->cotizarPlan($request)->getData();

            array_push($respuestas, $resp);
        }

        return response()->json($respuestas);
    }

    public function cotizarPlan(Request $request){

        extract($request->all());

            // se buscan las coberturas del plan
            $paramsCobertura = [
                'codigoplan'          => $plan['codigoPlan'],
                'codigoclasevehiculo' => $dataSelected['clasevehiculo'],
                'codigociudad'        => $dataSelected['ciudadescirculacion'],
                'modelovehiculo'      => $dataSelected['modelo'],
                'feinivigencia'       => $dataSelected['feinivigencia'],
                'canal'               => 'TraditionalChannel',
                'organizacion'        => 'Sura',
            ];

            $coberturas = $this->getCoberturas($request, json_encode($paramsCobertura))->getData();

            // Dentro del array de coberturas, hay una propiedad que tiene las verdaderas coberturas. Se mapea para solo 
            // obtener el codigo

            $coberturasMap = array_map(function($item){
                $cdcobertura = array_map(function($item2){
                    return $item2->cdCobertura;
                }, $item->coberturas);

                return reset($cdcobertura);
            }, $coberturas);

            // se inspecciona (NO SE UTILIZA AUN)

            // $paramsInspeccionar = [
            //     'esCeroKm' => true,
            //     'placa' => $dataSelected['placa'],
            //     'plan' => $plan->codigoPlan,
            //     'operacion' => 'Submission',
            //     'esBlindado' => false,
            //     'modelo' => $dataSelected['modelo'],
            //     'coberturas' => json_encode($coberturasMap)
            // ];

            // $request = new \Illuminate\Http\Request();

            // $request->setMethod('POST');
            // $request->request->add($paramsInspeccionar);

            // $inspeccionar = $this->inspeccion($request)->getData();



            // finalmente, se crea el objeto de tarifa

            $dsMarca = $this->findSelected($fasecoldaMarcas, 'codigoMarca', $dataSelected['fasecoldaMarcas']);
            $dsLineas = $this->findSelected($fasecoldaLineas, 'descripcionselect', $dataSelected['fasecoldaLineas']);
            
            // dd("xd");

            $dataSelected['cname'] = $dataSelected['cname'] == ''? 'USER' : $dataSelected['cname'];
            $dataSelected['capellido'] = $dataSelected['capellido'] == ''? 'USER' : $dataSelected['capellido'];

            $tarifar = [
                'planSeleccionado' => $plan,
                'grupoCoberturas' => $coberturas,
                'infoVehiculo' => [
                    "placa" => $dataSelected['placa'],
                    "modelo" => $dataSelected['modelo'],
                    "fasecolda" => $fasecoldaInfo['fasecolda'],
                    "cdClase" => $dataSelected['clasevehiculo'],
                    "cdMarca" => $dataSelected['fasecoldaMarcas'],
                    "cdLinea" => "01601274",
                    "cdTipoServicio" => $dataSelected['tiposservicio'],
                    "snCeroKm" => false,
                    "codigoCiudad" => $dataSelected['ciudadescirculacion'],
                    "valorAsegurado" => $dsLineas['valorAsegurado'], // fasecoldainfo tambien tiene valor asegurado
                    "valorSugerido" => 28600000,
                    "usoVehiculo" => $dataSelected['uso'],
                    "cdDispositivoSeguridad" => "GpsSura",
                    "dsClase" => $fasecoldaInfo['fasecoldaInfo']['clase'],
                    "dsMarca" => $dsMarca['descripcion'],
                    "dsLinea" => $dsLineas['descripcionLineaCompleto'],
                    "valorAccesorios" => 0,
                    "blindado" => false,
                    "chasis" => $fasecoldaInfo['chasis'],
                    "motor" => $fasecoldaInfo['motor'],
                    "tieneGas" => false,
                    "thermoking" => false,
                    "valorAccesoriosEspeciales" => 0,
                    "cdZonaCirculacion" => "2",
                    "cdGrupoTarifa" => $dsLineas['codigoGrupoTarifa'],
                    "cdMarcaLinea" => $dsLineas['codigoMarcaLinea'],
                    "inspeccionValida" => false,
                    "codigoClave1" => $dsLineas['codigoClave1'],
                    "codigoClave3" => $dsLineas['codigoClave3'],
                    "codigoClave4" => $dsLineas['codigoClave4'],
                    "codigoClave7" => $dsLineas['codigoClave7']
                ],
                'tomadorPrincipal' => [
                    'datosPersonales' => [
                        'identificacion' => [
                            'numero' => $dataSelected['numeroDoc'] == ''? '11111111' : $dataSelected['numeroDoc'],
                            'tipo'   => $tiposdocumento[1],
                        ],
                        "primerNombre" => $dataSelected['cname'],
                        "segundoNombre" => "USER",
                        "primerApellido" => $dataSelected['capellido'],
                        "segundoApellido" => "USER",
                        "nombreCompleto" => $dataSelected['cname'].' '.$dataSelected['capellido'],
                        "fechaNacimiento" => "1990-08-09T05:00:00Z", // nacimiento
                        "sexo"  => 'M',
                        "ocupacion"  => $ocupaciones[0],
                        "tipoPersona" => $dataSelected['tipoPersona'],
                        "numeroCelular" => '3115529981',//$dataSelected['telefono'], // telefono
                        "estadoCivil" => 'S',
                        "edad" => 29, // calcular edad
                        'direcciones' => [
                            [
                              "tipoDireccion" => $tiposdireccion[0],
                              "direccion" => "CR10",
                              "numeroTelefono" => "2123122",
                              "esCorrespondencia" => "S",
                              "email" => "rf@rf.com",
                              "esEmailCorrespondencia" => "S",
                              "codigoDepartamento" => "05",
                              "codigoDaneSura" => "05001000",
                              "municipio" => "4292",
                              "codigoPostal" => "76001"
                            ]
                        ],
                    ]
                ],
                'asegurados' => [
                    [
                      'datosPersonales' => [
                            'identificacion' => [
                                'numero' => $dataSelected['numeroDoc'] == ''? '11111111' : $dataSelected['numeroDoc'],
                                'tipo'   => $tiposdocumento[1],
                            ],
                            "primerNombre" => $dataSelected['cname'],
                            "segundoNombre" => "USER",
                            "primerApellido" => $dataSelected['capellido'],
                            "segundoApellido" => "USER",
                            "nombreCompleto" => $dataSelected['cname'].' '.$dataSelected['capellido'],
                            "fechaNacimiento" => "1990-08-09T05:00:00Z", // nacimiento
                            "sexo"  => 'M',
                            "ocupacion"  => $ocupaciones[0],
                            "tipoPersona" => $dataSelected['tipoPersona'],
                            "numeroCelular" => '3115529981',//$dataSelected['telefono'], // telefono
                            "estadoCivil" => 'S',
                            "edad" => 29, // calcular edad
                            'direcciones' => [
                                [
                                  "tipoDireccion" => $tiposdireccion[0],
                                  "direccion" => "CR10",
                                  "numeroTelefono" => "2123122",
                                  "esCorrespondencia" => "S",
                                  "email" => "rf@rf.com",
                                  "esEmailCorrespondencia" => "S",
                                  "codigoDepartamento" => "05",
                                  "codigoDaneSura" => "05001000",
                                  "municipio" => "4292",
                                  "codigoPostal" => "76001"
                                ]
                            ],
                      ]
                    ]
                ],
                "feInicioVigencia" => "2018-11-02T05:00:00.000Z",
                "esColectiva" => false,
                "feFinVigencia" => "2019-11-02T05:00:00.000Z",
                "codigoAsesor" => "660",
                "codigoOrganizacion" => "Sura",
                "codigoCanal" => "TraditionalChannel",
                "fechaCotizacion" => "2019-11-15T15:15:17.234Z",
                "codigoOficina" => "4030",
                "medioVenta" => "1",
                "codigoPolizaVenta" => "PPAutos"
            ];

            $requestCotizar = new \Illuminate\Http\Request();

            $requestCotizar->setMethod('POST');
            $requestCotizar->request->add($tarifar);

            $resp = $this->cotizar($requestCotizar)->getData();

            return response()->json($resp);
    }

    private function findSelected($array, $key, $value){
        $selectedItem = array_filter($array, function($item) use ($value, $key){
            return ($item[$key] == $value);
        });

        return reset($selectedItem);
    }

    private function initConfigApiSura($newurl = ''){

        return new \GuzzleHttp\Client([
            'base_uri' => $newurl == ''? $this->apisura : $newurl,
            'headers' => $this->apikeysura,
            'debug' => false,
            'verify' => false
        ]); 
    }

    private function getResult($requestComplete){
        return json_decode( (String) $requestComplete->getBody());
    }


}
