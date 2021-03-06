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
use App\ClientsCompanyContact;
use App\Files;
use DateTime;

class ImportController extends Controller
{

   function reprocesar(){
      $policies = Policies::all();

      foreach ($policies as $item) {
        
        $perc = PoliciesCousinsCommissions::where('id_policies', $item->id_policies)->first();
        
        if($perc == null)
          continue;

          if($perc->percentage_vat_cousin == 0 && $perc->commission_percentage == 0){
            $originalInsure = InsurersBranchs::where('id_branch', $item->branch)->where('id_insurers', $item->insurers)->first();

            if($originalInsure == null)
              continue;

          //  dump($originalInsure);
            $perc->percentage_vat_cousin = $originalInsure->vat_percentage;
            $perc->commission_percentage = $originalInsure->commission_percentage;
        dd($perc);

            $perc->save();
          }
          

      }
   }

   public function company(){
        ini_set("default_charset", "UTF-8");

       $fila = 0;

       $data = [];
       $data_contact = [];
       $data_notifications = [];
       $data_auditoria = [];

        if (($gestor = fopen("clients-company.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                
                $datos = array_map("utf8_encode", $datos);

                if($fila == 0){
                  $fila++;
                  continue;
                }

                 $fecha = DateTime::createFromFormat('d/m/Y', $datos[7]);
                 $fecha = $fecha == false? null : $fecha->format('Y-m-d');

                 $row = array(
                    "business_name"   => trim($datos[1]),
                    "nit"             => trim($datos[4]),
                    "expedition_date" => null,
                    "constitution_date" => null,
                    "data_treatment"    => 1,
                    "observations"    => null,
                 );

                 $store = ClientsCompany::create($row);

                 $auditoria = array(
                    "tabla"      => "clients_company",
                    "cod_reg"    => $store["id_clients_company"],
                    "status"     => 1,
                    "usr_regins" => 68
                 );
                 

                 $contact = array(
                    "id_clients_company" => $store["id_clients_company"],
                    "department"        => trim($datos[18]),
                    "city"              => trim($datos[19]),
                    "address1"          => trim($datos[20]),
                    "type_address1"     => trim($datos[21]),
                    "address2"          => trim($datos[22]),
                    "type_address2"     => trim($datos[23]),
                    "phone1"            => trim($datos[24]),
                    "type_phone1"       => trim($datos[25]),
                    "phone2"            => trim($datos[26]),
                    "type_phone2"       => trim($datos[27]),
                    "email"             => trim($datos[28]),
                 );
                


                 $notifications = array(
                    "id_clients_company"               => $store["id_clients_company"],
                    "send_policies_for_expire_email"   => 1,
                    "send_portfolio_for_expire_email"  => 1,
                    "send_policies_for_expire_sms"     => 1,
                    "send_portfolio_for_expire_sms"    => 1, 
                    "send_birthday_card"               => 1,
                 );


                 $data_contact[]       = $contact;
                 $data_notifications[] = $notifications;
                 $data_auditoria[]     = $auditoria;

            }

            $store_clients_people               = ClientsCompanyContact::insert($data_contact);
            $store_clients_notification         = ClientsNotifications::insert($data_notifications);
            $store_auditoria                    = Auditoria::insert($data_auditoria);
                
            fclose($gestor);
        }

   }

    //csv clientes
    public function import()
    {
        ini_set("default_charset", "UTF-8");
       $fila = 0;

       $data = [];
       $data_contact = [];
       $data_info = [];
       $data_working = [];
       $data_notifications = [];
       $data_auditoria = [];

        if (($gestor = fopen("clients.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                
                $datos = array_map("utf8_encode", $datos);

                if($fila == 0){
                  $fila++;
                  continue;
                }

                 $fecha = DateTime::createFromFormat('d/m/Y', $datos[7]);
                 $fecha = $fecha == false? null : $fecha->format('Y-m-d');

                 $row = array(
                    "names"           => trim($datos[1]),
                    "last_names"      => trim($datos[2]),
                    "type_document"   => trim($datos[3]),
                    "number_document" => trim($datos[4]),
                    "expedition_date" => null,
                    "gender"          => trim($datos[6]),
                    "birthdate"       => $fecha,
                    "stratum"         => null,
                    "data_treatment"  => 1,
                    "observations"    => null,
                 );

                 $store = ClientsPeople::create($row);

                 $auditoria = array(
                    "tabla"      => "clients_people",
                    "cod_reg"    => $store["id_clients_people"],
                    "status"     => 1,
                    "usr_regins" => 68
                 );
                 

                 $pais = DB::table('departamentos')->where('nombre', trim($datos[18]))->first();
                 $city = DB::table('municipios')->where('nombre', trim($datos[19]))->first();

                 $contact = array(
                    "id_clients_people" => $store["id_clients_people"],
                    "id_department"     => $pais == null? null : $pais->id,
                    "id_city"           => $city == null? null : $city->id,
                    "address1"          => trim($datos[20]),
                    "type_address1"     => trim($datos[21]),
                    "address2"          => trim($datos[22]),
                    "type_address2"     => trim($datos[23]),
                    "phone1"            => trim($datos[24]),
                    "type_phone1"       => trim($datos[25]),
                    "phone2"            => trim($datos[26]),
                    "type_phone2"       => trim($datos[27]),
                    "email"  => trim($datos[28]),
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

            }

            $store_clients_people               = ClientsPeopleContact::insert($data_contact);
            $store_clients_people_info_crm      = ClientsPeopleInfoCrm::insert($data_info);
            $store_clients_notification         = ClientsNotifications::insert($data_notifications);
            $store_clients_working_informations = ClientsWorkingInformation::insert($data_working);
            $store_auditoria                    = Auditoria::insert($data_auditoria);
                
            fclose($gestor);
        }
        
    }

    function policies2(){
        $fila = 0;
        $count = 0;

        if (($gestor = fopen("Polizas-restantes.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                if($fila == 0){
                    $fila++;
                    continue;
                }

                $datos[4] = trim(utf8_encode($datos[4]));
                $datos[5] = trim(utf8_encode($datos[5]));
                $datos[11] = trim(utf8_encode($datos[11]));

                $name = str_replace(' ', '', str_replace('.', '', trim($datos[11])));

                $clientePeople = ClientsPeople::where(DB::raw("replace(CONCAT(names,last_names), ' ', '')"), 'like', '%'.$name.'%')->first();

                if($clientePeople == null){
                    $clientePeople = ClientsCompany::where(DB::raw("replace(replace(business_name, '.', ''), ' ', '')"), 'like', '%'.$name.'%')->first();
                }

                if($clientePeople == null){

                }

                $name4 = str_replace(' ', '', str_replace('.', '', trim($datos[4])));
                $name9 = str_replace(' ', '', str_replace('.', '', trim($datos[5])));

                $insure = Insurers::where(DB::raw("replace(name, ' ', '')"), 'like', '%'.$name4.'%')->get()->first();
                $branch = Branchs::where(DB::raw("replace(name, ' ', '')"), 'like', '%'.$name9.'%')->get()->first();

                if($insure == null){
                    $count++;

                    if($fila < 9000){
                      echo ($name4);
                      echo "<br> Inseure Fila: ".$fila;
                      echo "<br>";
                    }
                }        

                if($branch == null){
                    $count++;

                    if($fila < 9000){
                      echo ($name9);
                      echo "<br> Branch Fila: ".$fila;
                      echo "<br>";
                    }
                }                


                if($fila == 7975){
                  echo "olis";
                  echo $count;
                  die;
                }

                $fila++;

            }
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

        if (($gestor = fopen("Polizas-restantes.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                if($fila == 0){
                    $fila++;
                    continue;
                }

                $datos = array_map("utf8_encode", $datos);

                $datos[10] = utf8_encode($datos[10]);
                $datos[11] = utf8_encode($datos[11]);
                $datos[12] = utf8_encode($datos[12]);
                $datos[14] = utf8_encode($datos[14]);
                $datos[18] = utf8_encode($datos[18]);

                $name = str_replace(' ', '', str_replace('.', '', trim($datos[11])));

                $clientePeople = ClientsPeople::select("id_clients_people as id")->where(DB::raw("replace(CONCAT(names,last_names), ' ', '')"), 'like', '%'.$name.'%')->first();

                $type_clients = 0;

                if($clientePeople == null){
                  
                    $clientePeople = ClientsCompany::select("id_clients_company as id")->where(DB::raw("replace(replace(business_name, '.', ''), ' ', '')"), 'like', '%'.$name.'%')->first();
                    
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


               $expedition_date = DateTime::createFromFormat('d/m/Y', $datos[6]);
               $expedition_date = $expedition_date == false? null : $expedition_date->format('Y-m-d');

               $reception_date = DateTime::createFromFormat('d/m/Y', $datos[7]);
               $reception_date = $reception_date == false? null : $reception_date->format('Y-m-d');

               $start_date = DateTime::createFromFormat('d/m/Y', $datos[8]);
               $start_date = $start_date == false? null : $start_date->format('Y-m-d');

               $end_date = DateTime::createFromFormat('d/m/Y', $datos[9]);
               $end_date = $end_date == false? null : $end_date->format('Y-m-d');

                $array = [
                  "type_poliza"                     => strtolower(trim($datos[0])),
                  "number_policies"                 => trim($datos[1]),
                  "state_policies"                  => ucwords(trim(strtolower($datos[2]))),
                  "is_renewable"                    => trim($datos[3]),
                  "insurers"                        => $insure->id_insurers,
                  "branch"                          => $branch->id_branchs,
                  "expedition_date"                 => $expedition_date,
                  "reception_date"                  => $reception_date,
                  "start_date"                      => $start_date,
                  "end_date"                        => $end_date,
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
