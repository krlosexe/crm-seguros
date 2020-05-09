<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

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
use App\PoliciesAnnexes;

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

          // if($perc->percentage_vat_cousin == 0 && $perc->commission_percentage == 0){
            $originalInsure = InsurersBranchs::where('id_branch', $item->branch)->where('id_insurers', $item->insurers)->first();

            if($originalInsure == null)
              continue;

          //  dump($originalInsure);
            $perc->percentage_vat_cousin = $originalInsure->vat_percentage;
            $perc->commission_percentage = $originalInsure->commission_percentage;

            $perc->save();
          // }
          

      }
   }

   function reprocesarRamos(){
     $policies = Policies::all();

     foreach ($policies as $item) {
            $originalInsure = InsurersBranchs::where('id_branch', $item->branch)->where('id_insurers', $item->insurers)->first();

            if($originalInsure == null){
              $create = [
                  'id_insurers' => $item->insurers,
                  'id_branch' => $item->branch,
                  'code' => 0,
                  'commission_percentage' => 0,
                  'vat_percentage' => 0,
              ];

              InsurersBranchs::create($create);
            }

     }
   }

   function anexos(){

       ini_set("default_charset", "utf-8");
       ini_set("pcre.backtrack_limit", "50000000");
       ini_set("memory_limit", "-1");
       set_time_limit(0);

       $noEncontrados = array();

        $reader = ReaderEntityFactory::createReaderFromFile('anexos.xlsx');

        $reader->open('anexos.xlsx');
        foreach ($reader->getSheetIterator() as $key2 => $sheet) {

            foreach ($sheet->getRowIterator() as $key => $row) {

                if($key == 1)
                  continue;

                $cells = array_map(function($item){
                  return $item->getValue();
                }, $row->getCells());

                $policie = Policies::where('number_policies', $cells[0])->first();

                if($policie == null){

                  array_unshift($cells, 'No encontrado, fila: '.$key);

                  array_push($noEncontrados, $cells);

                  continue;
                }


                $expedition_date = true;
               if($cells[6] == '')
                 $expedition_date = false;

               $expedition_date = $expedition_date == false? '0000-00-00' : $cells[6]->format('Y-m-d');

                $start_date = true;
               if($cells[7] == '')
                 $start_date = false;

               $start_date = $start_date == false? '0000-00-00' : $cells[7]->format('Y-m-d');

                $end_date = true;
               if($cells[8] == '')
                 $end_date = false;

               $end_date = $end_date == false? '0000-00-00' : $cells[8]->format('Y-m-d');


                $datos = [
                  'id_policie' => $policie->id_policies,
                  'number_annexed' => $cells[1],
                  'state' => $cells[2],
                  'risk' => $cells[3] == ''? '' : $cells[3],
                  'is_renewable' => $cells[4],
                  'reason' => $cells[5],
                  'expedition_date' => $expedition_date,
                  'start_date' => $start_date,
                  'end_date' => $end_date,
                  'reception_date' => '0000-00-00',
                  'cousin' => $cells[10],
                  'xpenses' => $cells[11],
                  'vat' => $cells[12],
                  'percentage_vat_cousin' => $cells[13],
                  'commission_percentage' => $cells[14],
                  'agency_commission' => $cells[15],
                  'total' => '',
                  'payment_method' => '',
                  'observations' => '',
                  'accessories' => '',
                ];

                $store = PoliciesAnnexes::create($datos);

                $auditoria              = new Auditoria;
                $auditoria->tabla       = "policies_annexes";
                $auditoria->cod_reg     = $store->id_policies_annexes;
                $auditoria->status      = 1;
                $auditoria->usr_regins  = 68;
                $auditoria->save();
                
            }

            break;
        }

        $reader->close();


          $csv = '';

          foreach ($noEncontrados as $record){
            foreach ($record as $key => $value) {

                $value = gettype($value) != 'object'? $value : $value->format('d/m/Y');

                $csv = $csv . $value.';';
            }

            $csv = $csv . "\n";
          }

        $csv_handler = fopen ('annexes-notfound.csv','w');
        fwrite ($csv_handler,$csv);
        fclose ($csv_handler);
                

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

       $result = DB::table('clients_people')->select('last_names','number_document')->where('last_names', 'like', '%¥%')->get()->toArray();

       $das = '';

       foreach ($result as $value) {
          $value->last_names = str_replace('¥', 'Ñ', $value->last_names);

          $das = $das . "UPDATE clients_people SET last_names = '".$value->last_names."' WHERE number_document = ".$value->number_document.";<br>";

       }

       echo $das;die;

        if (($gestor = fopen("clients-inactivos2.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                
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

    public function policies()
    {
       
       ini_set("default_charset", "utf-8");
       ini_set("pcre.backtrack_limit", "50000000");
       ini_set("memory_limit", "-1");
       set_time_limit(0);

       $fila = 0;
       $noEncontrados = array();

        $reader = ReaderEntityFactory::createReaderFromFile('Polizas-restantes.xlsx');

        $reader->open('Polizas-faltantes.xlsx');

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $key => $row) {

                if($key == 1)
                  continue;

                $cells = array_map(function($item){
                  return $item->getValue();
                }, $row->getCells());

                $name = str_replace(' ', '', str_replace('.', '', trim($cells[11])));
                
                // $clientePeople = ClientsPeople::select("id_clients_people as id")->where(DB::raw("replace(CONCAT(names,last_names), ' ', '')"), 'like', '%'.$name.'%')->first();

                $clientePeople = ClientsPeople::select("id_clients_people as id")->where('number_document', $cells[14])->first();

                $type_clients = 0;

                if($clientePeople == null){
                  
                    // $clientePeople = ClientsCompany::select("id_clients_company as id")->where(DB::raw("replace(replace(business_name, '.', ''), ' ', '')"), 'like', '%'.$name.'%')->first();
                    $clientePeople = ClientsCompany::select("id_clients_company as id")->where('nit', $cells[14])->first();
                    
                    $type_clients = 1;
                }

                if($clientePeople == null){

                    array_unshift($cells, 'Cliente no encontradola. FILA: '.$key);

                    array_push($noEncontrados, $cells);

                    continue;
                }

                $insure = str_replace(' ', '', str_replace('.', '', trim($cells[4])));
                $branch = str_replace(' ', '', str_replace('.', '', trim($cells[5])));

                $insure = Insurers::where(DB::raw("replace(replace(name, '.', ''), ' ', '')"), 'like', '%'.$insure.'%')->get()->first();
                $branch = Branchs::where(DB::raw("replace(replace(name, '.', ''), ' ', '')"), 'like', '%'.$branch.'%')->get()->first();

                if($insure == null || $branch == null){

                    array_unshift($cells, 'Aseguradora o Ramo no encontrado. FILA: '.$key);

                    array_push($noEncontrados, $cells);
                    continue;
                }

                $expedition_date = true;
               if($cells[6] == '')
                 $expedition_date = false;

               $expedition_date = $expedition_date == false? null : $cells[6]->format('Y-m-d');

                $reception_date = true;
               if($cells[7] == '')
                 $reception_date = false;

               $reception_date = $reception_date == false? null : $cells[7]->format('Y-m-d');

                $start_date = true;
               if($cells[8] == '')
                 $start_date = false;

               $start_date = $start_date == false? null : $cells[8]->format('Y-m-d');

                $end_date = true;
               if($cells[9] == '')
                 $end_date = false;

               $end_date = $end_date == false? null : $cells[9]->format('Y-m-d');

                $array = [
                  "type_poliza"                     => strtolower(trim($cells[0])),
                  "number_policies"                 => trim($cells[1]),
                  "state_policies"                  => ucwords(trim(strtolower($cells[2]))),
                  "is_renewable"                    => trim($cells[3]),
                  "insurers"                        => $insure->id_insurers,
                  "branch"                          => $branch->id_branchs,
                  "expedition_date"                 => $expedition_date,
                  "reception_date"                  => $reception_date,
                  "start_date"                      => $start_date,
                  "end_date"                        => $end_date,
                  "risk"                            => trim($cells[10]),
                  "type_clients"                    => $type_clients,
                  "clients"                         => $clientePeople->id,
                  "name_taker"                      => trim($cells[12]),
                  "identification_taker"            => trim($cells[13]),
                  "name_insured"                    => trim($cells[14]),
                  "identification_insured"          => trim($cells[15]),
                  "beneficiary_remission"           => 0,
                  "beneficairy_onerous"             => 0,
                  "beneficairy_name"                => trim($cells[18]),
                  "beneficairy_identification"      => trim($cells[19]),
                  "internal_observations"           => null,
                  "observations"                    => null,
                  "cousin"                          => (float) str_replace(',', '', $cells[20]),
                  "xpenses"                         => null,
                  "vat"                             => 0,
                  "percentage_vat_cousin"           => 0,
                  "commission_percentage"           => 0,
                  "participation"                   => 0,
                  "agency_commission"               => 0,
                  "total"                           => 0,
                  "placa"                           => trim($cells[28]),
                  "placas"                          => [trim($cells[28])],
                  "send_policies_for_expire_email"  => trim($cells[29]),
                  "send_portfolio_for_expire_email" => trim($cells[30]),
                  "send_policies_for_expire_sms"    => trim($cells[31]),
                  "send_portfolio_for_expire_sms"   => trim($cells[32]),
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
                
            }
        }

        $reader->close();

        dd($noEncontrados);
        
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

        $noEncontrados[] = [''];

        $reader = ReaderEntityFactory::createReaderFromFile('digitales-nuevos.xlsx');

        $reader->open('digitales-nuevos.xlsx');

        foreach ($reader->getSheetIterator() as $sheetKey => $sheet) {

           if($sheetKey == 1){

              foreach ($sheet->getRowIterator() as $key => $row) {

                  if($key == 1)
                    continue;

                  $cells = array_map(function($item){
                    return $item->getValue();
                  }, $row->getCells());

                  $policie = Policies::where('number_policies', (int) $cells[0])->first();

                  if($policie == null){

                    array_unshift($cells, 'No encontrado, fila: '.$key);

                    array_push($noEncontrados, $cells);

                    continue;
                  }

                  if ($cells[4] instanceof DateTime)
                    $cells[4] = $cells[4]->format('d/m/Y');

                  $array = [
                    "id_register"  => $policie->id_policies,
                    "name"         => $cells[2] == 'NULL'? '' : trim($cells[2]),
                    "title"        => $cells[3] == 'NULL'? '' : trim($cells[3]),
                    "descripcion"  => $cells[4] == 'NULL'? '' : trim($cells[4]),
                    "tabla"        => 'policies',
                  ];

                  $store_file = Files::create($array);

                  $auditoria              = new Auditoria;
                  $auditoria->tabla       = "files";
                  $auditoria->cod_reg     = $store_file["id_files"];
                  $auditoria->status      = 1;
                  $auditoria->usr_regins  = 68;
                  $auditoria->save();

              }
           }

           if($sheetKey == 2){

              foreach ($sheet->getRowIterator() as $key => $row) {

                  if($key == 1)
                    continue;

                  $cells = array_map(function($item){
                    return $item->getValue();
                  }, $row->getCells());

                  $clientePeople = ClientsPeople::select("id_clients_people as id")->where('number_document', trim($cells[1]))->first();
                  $type_clients = 'clients_people';

                  if($clientePeople == null){
                      $clientePeople = ClientsCompany::select("id_clients_company as id")->where('nit', 'like','%'.trim($cells[1]).'%')->first();
      
                      $type_clients = 'clients_company';
                  }

                  if($clientePeople == null){
                      $fila++;

                      array_unshift($cells, 'Cliente no encontradola. FILA: '.$fila);

                      array_push($noEncontrados, $cells);

                      continue;
                  }

                  if ($cells[5] instanceof DateTime)
                    $cells[5] = $cells[5]->format('d/m/Y');

                    $array = [
                      "id_register"  => $clientePeople->id,
                      "name"         => $cells[3] == 'NULL'? '' : trim($cells[3]),
                      "title"        => $cells[4] == 'NULL'? '' : trim($cells[4]),
                      "descripcion"  => $cells[5] == 'NULL'? '' : trim($cells[5]),
                      "tabla"        => $type_clients,
                    ];

                    $store_file = Files::create($array);

                    $auditoria              = new Auditoria;
                    $auditoria->tabla       = "files";
                    $auditoria->cod_reg     = $store_file["id_files"];
                    $auditoria->status      = 1;
                    $auditoria->usr_regins  = 68;
                    $auditoria->save();
                  
              }
           }

        }

        $reader->close();


        $csv = '';

          foreach ($noEncontrados as $record){
            foreach ($record as $key => $value) {

                $value = gettype($value) != 'object'? $value : $value->format('d/m/Y');

                $csv = $csv . $value.';';
            }

            $csv = $csv . "\n";
          }

        $csv_handler = fopen ('files-notfound.csv','w');
        fwrite ($csv_handler,$csv);
        fclose ($csv_handler);

        
    }

    public function filesAnnexes()
    {
       
       ini_set("default_charset", "utf-8");
       ini_set("pcre.backtrack_limit", "50000000");
       ini_set("memory_limit", "-1");
       set_time_limit(0);

        $fila = 0;
        $noEncontrados = array();

        $noEncontrados[] = [''];

        $reader = ReaderEntityFactory::createReaderFromFile('DigitalesAnexos.xlsx');

        $reader->open('DigitalesAnexos.xlsx');

        foreach ($reader->getSheetIterator() as $sheetKey => $sheet) {

           if($sheetKey == 1){

              foreach ($sheet->getRowIterator() as $key => $row) {

                  if($key == 1)
                    continue;

                  $cells = array_map(function($item){
                    return $item->getValue();
                  }, $row->getCells());

                  if ($cells[0] instanceof DateTime)
                    $cells[0] = 'NADA';

                  $policie = PoliciesAnnexes::where('number_annexed', (int) $cells[0])->first();

                  if($policie == null){

                    array_unshift($cells, 'No encontrado, fila: '.$key);

                    array_push($noEncontrados, $cells);

                    continue;
                  }

                  if ($cells[4] instanceof DateTime)
                    $cells[4] = $cells[4]->format('d/m/Y');

                  $array = [
                    "id_register"  => $policie->id_policies_annexes,
                    "name"         => $cells[2] == 'NULL'? '' : trim($cells[2]),
                    "title"        => $cells[3] == 'NULL'? '' : trim($cells[3]),
                    "descripcion"  => $cells[4] == 'NULL'? '' : trim($cells[4]),
                    "tabla"        => 'policies_annexes',
                  ];

                  $store_file = Files::create($array);

                  $auditoria              = new Auditoria;
                  $auditoria->tabla       = "files";
                  $auditoria->cod_reg     = $store_file["id_files"];
                  $auditoria->status      = 1;
                  $auditoria->usr_regins  = 68;
                  $auditoria->save();

              }
           }

        }

        $reader->close();


        $csv = '';

          foreach ($noEncontrados as $record){
            foreach ($record as $key => $value) {

                $value = gettype($value) != 'object'? $value : $value->format('d/m/Y');

                $csv = $csv . $value.';';
            }

            $csv = $csv . "\n";
          }

        $csv_handler = fopen ('files-annexes-notfound.csv','w');
        fwrite ($csv_handler,$csv);
        fclose ($csv_handler);

        
    }


    // los clients 399 están mal guardados, aqui se reprocesan

    function reprocesarpolicies(){
       $policiesConsulta = Policies::where('type_clients', 1)->where('clients', 399)->get();

       $policiesConsulta = array_map(function($item){
         return $item['number_policies'];
       }, $policiesConsulta->toArray());

        $reader = ReaderEntityFactory::createReaderFromFile('policiesnuevas.xlsx');

        $reader->open('policiesnuevas.xlsx');

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $key => $row) {

                if($key == 1)
                  continue;

                $cells = array_map(function($item){
                  return $item->getValue();
                }, $row->getCells());

                
                if(in_array($cells[1], $policiesConsulta)){

                    $name = str_replace(' ', '', str_replace('.', '', trim($cells[11])));

                    $clientePeople = ClientsPeople::select("id_clients_people as id")->where(DB::raw("replace(CONCAT(names,last_names), ' ', '')"), 'like', '%'.$name.'%')->first();


                    $type_clients = 0;

                    if($clientePeople == null){
                      
                        $clientePeople = ClientsCompany::select("id_clients_company as id")->where(DB::raw("replace(replace(business_name, '.', ''), ' ', '')"), 'like', '%'.$name.'%')->first();
                        
                        $type_clients = 1;
                    }

                    if($clientePeople != null){

                      Policies::where('number_policies', $cells[1])->update(['type_clients' => $type_clients, 'clients' => $clientePeople->id]);

                    }
                  
                }
                // $cells[1];


            }
        }

    }


}
