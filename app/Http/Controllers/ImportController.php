<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientsPeople;
use App\Auditoria;
use App\ClientsPeopleContact;
use App\ClientsPeopleInfoCrm;
use App\ClientsNotifications;
use App\ClientsWorkingInformation;


class ImportController extends Controller
{
    public function import()
    {
        ini_set("default_charset", "UTF-8");
        $fila = 1;

        $data = [];
        $data_contact = [];
        $data_info = [];
        $data_working = [];
        $data_notifications = [];

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

                 

                 $data[] = $row;
                 $store = ClientsPeople::create($row);

                 $auditoria              = new Auditoria;
                 $auditoria->tabla       = "clients_people";
                 $auditoria->cod_reg     = $store["id_clients_people"];
                 $auditoria->status      = 1;
                 $auditoria->usr_regins  = 68;
                 $auditoria->save();


                 $contact = array(
                    "id_clients_people" => $store["id_clients_people"],
                    "department"        => null,
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
                    "id_clients_people" => $store["id_clients_people"],
                    "marital_status"    => null,
                    "monthly_income"    => null,
                    "heritage"          => null,
                    "own_house"         => null,
                    "number_house"      => null,
    
                 );


                 $working = array(
                    "id_clients_people" => $store["id_clients_people"],
                    "occupation"        => null,
                    "company"           => null,
                 );


                 $notifications = array(
                    "id_clients"                       => $store["id_clients_people"],
                    "send_policies_for_expire_email"   => 1,
                    "send_portfolio_for_expire_email"  => 1,
                    "send_policies_for_expire_sms"     => 1,
                    "send_portfolio_for_expire_sms"    => 1, 
                    "send_birthday_card"               => 1,
                 );


                 $data_contact[]       = $contact;
                 $data_info[]          = $infocrm;
                 $data_working[]       = $working;
                 $data_notifications[] = $notifications;


                 //echo json_encode($contact);
            }
        //     echo "asd";
            $store_clients_people               = ClientsPeopleContact::insert($data_contact);
            $store_clients_people_info_crm      = ClientsPeopleInfoCrm::insert($data_info);
            $store_clients_notification         = ClientsNotifications::insert($data_notifications);
            $store_clients_working_informations = ClientsWorkingInformation::insert($data_working);
                
            fclose($gestor);
        }
        
    }
}
