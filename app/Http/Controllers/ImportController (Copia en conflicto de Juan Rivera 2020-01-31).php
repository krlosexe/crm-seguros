<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientsPeople;
class ImportController extends Controller
{
    public function import()
    {
        ini_set("default_charset", "UTF-8");
        $fila = 1;

        $data = [];

        if (($gestor = fopen("data.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {

                $numero = count($datos);
                echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
                $fila++;

                 $row = array(
                    "names"           => $datos[1],
                    "last_names"      => $datos[2],
                    "type_document"   => $datos[3],
                    "number_document" => $datos[4],
                    "expedition_date" => null,
                    "gender"          => $datos[6],
                    "birthdate"       => $datos[7],
                    "stratum"         => null,
                    "data_treatment"  => $datos[8],
                    "observations"    => null,
                 );



                 $contact = array(
                    "departament"       => null,
                    "city"              => $datos[19],
                    "address1"          => $datos[20],
                    "type_address1"     => $datos[21],
                    "address2"          => null,
                    "type_address2"     => null,
                    "phone1"            => null,
                    "type_phone1"       => null,
                    "phone2"            => null,
                    "type_phone2"       => null,
                 );


                 $infocrm = array(
                    "marital_status"    => null,
                    "monthly_income"    => null,
                    "heritage"          => null,
                    "own_house"         => null,
                    "number_house"      => null,
    
                 );


                 $working = array(
                    "occupation"    => null,
                    "company"       => null,
                 );


                 $notifications = array(
                    "send_polices_for_expire_email"    => 1,
                    "send_portfolio_for_expire_email"  => 1,
                    "send_policies_for_expire_sms"     => 1,
                    "send_portfolio_for_expire_sms"    => 1, 
                    "send_birthday_card"               => 1,
                 );
                 

                 $data[] = $row;
                 $store = ClientsPeople::create($row());

                //  $auditoria              = new Auditoria;
                //  $auditoria->tabla       = "clientes";
                //  $auditoria->cod_reg     = $cliente["id_cliente"];
                //  $auditoria->status      = 1;
                //  $auditoria->usr_regins  = 69;
                //  $auditoria->save();


                 echo json_encode($contact);
            }
        //     echo "asd";
           
                
            fclose($gestor);
        }
        
    }
}
