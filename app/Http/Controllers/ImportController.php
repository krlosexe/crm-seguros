<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\ClientsPeople;
use App\Auditoria;
use App\ClientsPeopleContact;
use App\ClientsPeopleInfoCrm;
use App\ClientsNotifications;
use App\ClientsWorkingInformation;

use App\Policies;
use App\PoliciesInfoTakerInsuredBeneficiary;
use App\PoliciesObservations;
use App\PoliciesCousinsCommissions;
use App\PoliciesNotifications;
use App\PoliciesInfoPayments;
use App\PolicesVehicles;

use App\InsurersBranchs;

use App\Insurers;
use App\Branchs;
use App\ClientsCompany;
use App\Files;

class ImportController extends Controller
{

   function reprocesar(){
      $policies = Policies::all();

      foreach ($policies as $item) {
        
        $perc = PoliciesCousinsCommissions::find($item->id_policies);

        if($perc == null)
          continue;

          if($perc->percentage_vat_cousin == 0 && $perc->commission_percentage == 0){
            $originalInsure = InsurersBranchs::where('id_branch', $item->branch)->where('id_insurers', $item->insurers)->first();

            if($originalInsure == null)
              continue;

            $perc->percentage_vat_cousin = $originalInsure->vat_percentage;
            $perc->commission_percentage = $originalInsure->commission_percentage;

            $perc->save();
          }
          

      }
   }

    //csv clientes
    public function import()
    {
        ini_set("default_charset", "UTF-8");
       $fila = 1;

       $data = [];
       $data_contact = [];
       $data_info = [];
       $data_working = [];
       $data_notifications = [];
       $data_auditoria = [];

        if (($gestor = fopen("data202004.csv", "r")) !== FALSE) {
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
                    "data_treatment"  => 1,
                    "observations"    => null,
                 );

                 

                 $data[] = $row;
                 $store = ClientsPeople::create($row);

                 $auditoria = array(
                    "tabla"      => "clients_people",
                    "cod_reg"    => $store["id_clients_people"],
                    "status"     => 1,
                    "usr_regins" => 68
                 );


                 $contact = array(
                    "id_clients_people" => $store["id_clients_people"],
                    "department"        => $datos[18],
                    "city"              => $datos[19],
                    "address1"          => $datos[20],
                    "type_address1"     => $datos[21],
                    "address2"          => $datos[22],
                    "type_address2"     => $datos[23],
                    "phone1"            => $datos[24],
                    "type_phone1"       => $datos[25],
                    "phone2"            => $datos[26],
                    "type_phone2"       => $datos[27],
                    "email"  => $datos[28],
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
                 $data_auditoria[]     = $auditoria;


                 echo json_encode($auditoria);
            }
        //     echo "asd";
            $store_clients_people               = ClientsPeopleContact::insert($data_contact);
            $store_clients_people_info_crm      = ClientsPeopleInfoCrm::insert($data_info);
            $store_clients_notification         = ClientsNotifications::insert($data_notifications);
            $store_clients_working_informations = ClientsWorkingInformation::insert($data_working);
            $store_auditoria                    = Auditoria::insert($data_auditoria);
                
            fclose($gestor);
        }
        
    }

    public function policies()
    {
       
       ini_set("default_charset", "utf-8");
       ini_set("pcre.backtrack_limit", "50000000");
       ini_set("memory_limit", "-1");
       set_time_limit(0);

       $fila = 0;
       $noEncontrados = array();

        if (($gestor = fopen("policies202004-2.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                if($fila == 0){
                    $fila++;
                    continue;
                }

                $datos[10] = utf8_encode($datos[10]);
                $datos[11] = utf8_encode($datos[11]);
                $datos[12] = utf8_encode($datos[12]);
                $datos[14] = utf8_encode($datos[14]);
                $datos[18] = utf8_encode($datos[18]);

                $clientePeople = ClientsPeople::select("id_clients_people as id")
                                                ->where(DB::raw("CONCAT(names, ' ',last_names)"), trim($datos[11]))
                                                ->first();
                $type_clients = 0;

                if($clientePeople == null){
                    $clientePeople = ClientsCompany::select("id_clients_company as id")
                                                ->where('business_name', trim($datos[11]))->first();
    
                    $type_clients = 1;
                }

                if($clientePeople == null){
                    $fila++;

                    array_unshift($datos, 'Cliente no encontradola. FILA: '.$fila);

                    array_push($noEncontrados, $datos);

                    continue;
                }

                $insure = Insurers::where(['name' => trim($datos[4])])->get()->first();
                $branch = Branchs::where(['name' => trim($datos[5])])->get()->first();

                if($insure == null || $branch == null){
                    $fila++;

                    array_unshift($datos, 'Aseguradora o Ramo no encontrado. FILA: '.$fila);

                    array_push($noEncontrados, $datos);
                    continue;
                }

                $array = [
                  "type_poliza"                     => strtolower(trim($datos[0])),
                  "number_policies"                 => trim($datos[1]),
                  "state_policies"                  => ucwords(trim(strtolower($datos[2]))),
                  "is_renewable"                    => trim($datos[3]),
                  "insurers"                        => $insure->id_insurers,
                  "branch"                          => $branch->id_branchs,
                  "expedition_date"                 => trim($datos[6]),
                  "reception_date"                  => trim($datos[7]),
                  "start_date"                      => trim($datos[8]),
                  "end_date"                        => trim($datos[9]),
                  "risk"                            => trim($datos[10]),
                  "type_clients"                    => $type_clients,
                  "clients"                         => $clientePeople->id,
                  "name_taker"                      => trim($datos[12]),
                  "identification_taker"            => trim($datos[13]),
                  "name_insured"                    => trim($datos[14]),
                  "identification_insured"          => trim($datos[15]),
                  "beneficiary_remission"           => 0,
                  "beneficairy_onerous"             => 0,
                  "beneficairy_name"                => trim($datos[18]),
                  "beneficairy_identification"      => trim($datos[19]),
                  "internal_observations"           => null,
                  "observations"                    => null,
                  "cousin"                          => (float) str_replace(',', '', $datos[20]),
                  "xpenses"                         => null,
                  "vat"                             => 0,
                  "percentage_vat_cousin"           => 0,
                  "commission_percentage"           => 0,
                  "participation"                   => 0,
                  "agency_commission"               => 0,
                  "total"                           => 0,
                  "placa"                           => trim($datos[28]),
                  "placas"                          => [trim($datos[28])],
                  "send_policies_for_expire_email"  => trim($datos[29]),
                  "send_portfolio_for_expire_email" => trim($datos[30]),
                  "send_policies_for_expire_sms"    => trim($datos[31]),
                  "send_portfolio_for_expire_sms"   => trim($datos[32]),
                  "payment_method"                  => null,
                  "payment_date"                    => null,
                  "id_user"                         => 68,
                ];

                $store = Policies::create($array);
                $array["id_policies"] = $store->id_policies;
 
   
                PoliciesInfoTakerInsuredBeneficiary::create($array);
                PoliciesObservations::create($array);
                PoliciesInfoPayments::create($array);

                if($array["type_poliza"] != "Collective"){
                    PoliciesCousinsCommissions::create($array);
                    PoliciesNotifications::create($array);
                }

                foreach($array['placas'] as $value){
                    $data["placa"]      = $value;
                    $data["id_policie"] = $store->id_policies;
                    PolicesVehicles::create($data);
                }

                $auditoria              = new Auditoria;
                $auditoria->tabla       = "policies";
                $auditoria->cod_reg     = $store->id_policies;
                $auditoria->status      = 1;
                $auditoria->usr_regins  = 68;
                $auditoria->save();
                
                $fila++;
            }
            fclose($gestor);
        }

        $f = fopen('php://output', 'w');

        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="policies-not-found.csv"');

        foreach ($noEncontrados as $value) {
            fputcsv($f, $value, ';');
        }
        
    }

    public function files()
    {
       
       ini_set("default_charset", "utf-8");
       ini_set("pcre.backtrack_limit", "50000000");
       ini_set("memory_limit", "-1");
       set_time_limit(0);

       $fila = 0;
       $noEncontrados = array();
/*
        if (($gestor = fopen("policies-files202004.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                if($fila == 0){
                    $fila++;
                    continue;
                }

                $policie = Policies::where(['number_policies' => $datos[0]])->get()->first();

                if($policie == null){

                  array_unshift($datos, 'Poliza no encontrada. FILA: '.$fila);

                  array_push($noEncontrados, $datos);

                  $fila++;
                  continue;
                }

                $array = [
                  "id_register"  => $policie->id_policies,
                  "name"         => $datos[2] == 'NULL'? '' : trim($datos[2]),
                  "title"        => $datos[3] == 'NULL'? '' : trim($datos[3]),
                  "descripcion"  => $datos[4] == 'NULL'? '' : trim($datos[4]),
                  "tabla"        => 'policies',
                ];

                $store_file = Files::create($array);

                $auditoria              = new Auditoria;
                $auditoria->tabla       = "files";
                $auditoria->cod_reg     = $store_file["id_files"];
                $auditoria->status      = 1;
                $auditoria->usr_regins  = 68;
                $auditoria->save();

                $fila++;
            }
            fclose($gestor);
        }
*/
        $fila = 0;
        $noEncontrados[] = [''];

        if (($gestor = fopen("clientes-files202004.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                if($fila == 0){
                    $fila++;
                    continue;
                }

                $clientePeople = ClientsPeople::select("id_clients_people as id")->where('number_document', trim($datos[1]))->first();
                $type_clients = 'clients_people';

                if($clientePeople == null){
                    $clientePeople = ClientsCompany::select("id_clients_company as id")->where('nit', 'like','%'.trim($datos[1]).'%')->first();
    
                    $type_clients = 'clients_company';
                }

                if($clientePeople == null){
                    $fila++;

                    array_unshift($datos, 'Cliente no encontradola. FILA: '.$fila);

                    array_push($noEncontrados, $datos);

                    continue;
                }

                if($datos[0] == 'NIT'){
                  $array = [
                    "id_register"  => $clientePeople->id,
                    "name"         => $datos[3] == 'NULL'? '' : trim($datos[3]),
                    "title"        => $datos[4] == 'NULL'? '' : trim($datos[4]),
                    "descripcion"  => $datos[5] == 'NULL'? '' : trim($datos[5]),
                    "tabla"        => $type_clients,
                  ];

                  $store_file = Files::create($array);

                  $auditoria              = new Auditoria;
                  $auditoria->tabla       = "files";
                  $auditoria->cod_reg     = $store_file["id_files"];
                  $auditoria->status      = 1;
                  $auditoria->usr_regins  = 68;
                  $auditoria->save();

                  $fila++;

                }
            }
            fclose($gestor);
        }

        $f = fopen('php://output', 'w');

        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="policies-file-not-found.csv"');

        foreach ($noEncontrados as $value) {
            fputcsv($f, $value, ';');
        }


        
    }


}
