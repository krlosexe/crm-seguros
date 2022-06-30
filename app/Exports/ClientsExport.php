<?php

namespace App\Exports;

use DB;
use App\User;
use App\Clients;
use App\Policies;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ClientsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    var $id_user;
    var $asesor;
    var $insurance;
    var $branch;
    var $date_init;
    var $date_finish;
    var $state;
    var $cedula;
    var $placa;


    public function view(): View
    {

        ini_set('memory_limit', '-1'); 
        ini_set('max_execution_time', 360);
        
        //$user = User::find(4124124124124);
        $user = null;
        
        $id_user      = $this->id_user;
        $state        = $this->state;
        $insurance    = $this->insurance;
        $branch       = $this->branch;
        $date_init    = $this->date_init;
        $date_finish  = $this->date_finish;
        $document     = $this->cedula;
        $placa        = $this->placa;


        $proximas_a_vencer = 0;

        $user = User::find($id_user);


        $data = Policies::select(
                            "policies.id_policies",
                            "policies.*", 
                            "insurers.name as name_insurers", 
                            "branchs.name as name_branchs",
                            "clients_people.names", 
                            "clients_people.last_names", 
                            "clients_people_contact.phone1 as phone_client", 
                            "clients_people_contact.phone2 as phone_client2", 
                            
                            "clients_company.business_name",  
                            "clients_company_contact.phone1 as phone_client", 
                            "clients_company_contact.phone2 as phone_clien2", 
                            DB::raw("CONCAT(clients_people.names, ' ', clients_people.last_names) AS fullname"), 
                            "auditoria.*",


                            "policies_info_taker_insured_beneficiary.*",
                            "policies_cousins_commissions.*"
        )

                                
                                ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients", "left")
                                ->join("clients_people_contact", "clients_people_contact.id_clients_people", "=", "policies.clients", "left")
                                ->join("clients_company", "clients_company.id_clients_company", "=", "policies.clients", "left")
                                ->join("clients_company_contact", "clients_company_contact.id_clients_company", "=", "policies.clients", "left")
                                ->join("insurers", "insurers.id_insurers", "=", "policies.insurers")
                                ->join("branchs", "branchs.id_branchs", "=", "policies.branch")

                                ->join("auditoria", "auditoria.cod_reg", "=", "policies.id_policies")
                               

                                ->join("policies_info_taker_insured_beneficiary", "policies_info_taker_insured_beneficiary.id_policies", "=", "policies.id_policies", "left")
                                ->join("policies_cousins_commissions", "policies_cousins_commissions.id_policies", "=", "policies.id_policies", "left")



                          
                                ->where("auditoria.tabla", "policies")
                                ->where("auditoria.status", "!=", "0")
                                ->where("policies.id_policies_grouped", "=", null)

            
                                



                                ->where(function($query) use ($user){
                                    if(!is_null($user) && $user->id_rol == 22){
                                        $query->where("policies.clients", $user->clients_company->id_clients_company);
                                        $query->where("policies.type_clients", 1);
                                        $query->where('policies.state_policies', 'Vigente');
                                    }
                                })


                                ->where(function ($query) use ($state) {
                                    if($state != "0"){
                                        $query->where("policies.state_policies", $state);
                                    }
                                })
                                ->where(function ($query) use ($insurance) {
                                    if($insurance != "0"){
                                        $query->where("policies.insurers", $insurance);
                                    }
                                })

                                ->where(function ($query) use ($branch) {
                                    if($branch != "0"){
                                        $query->where("policies.branch", $branch);
                                    }
                                })

                                ->where(function ($query) use ($date_init) {
                                    if($date_init != 0){
                                        $query->where("policies.end_date", ">=", $date_init);
                                    }
                                })

                                ->where(function ($query) use ($date_finish) {
                                    if($date_finish != 0){
                                        $query->where("policies.end_date", "<=", $date_finish);
                                    }
                                })

                                ->where(function ($query) use ($document) {
                                    if($document != "0"){
                                       $query->where("clients_people.number_document", $document);
                                    }
                                })

                                ->Orwhere(function ($query) use ($document) {
                                    if($document != "0"){
                                    $query->where("clients_company.nit", $document);
                                    }
                                })


                                ->when($placa, function ($query, $placa) {
                                    if($placa != "0"){
                                        return $query->join("policies_vehicle", "policies_vehicle.id_policie", "=", "policies.id_policies");
                                    }
                                })

                                ->where(function ($query) use ($placa) {
                                    if($placa != "0"){
                                        $query->where("policies_vehicle.placa", $placa);
                                    }
                                })



                                ->orderBy("policies.state_policies", "asc")
                                ->get();
          

        return view('exports.clients', [
            'data' => $data
        ]);
    }



    public function headings(): array
    {
        return [
            'nombres',
            'apellidos',
            'identificacion',
            'telefono',
            'email',
            'origen',

            'nombre_line',


            'forma_pago',
        ];
    }



    public function collection()
    {
        $users = DB::table('clientes')->select('nombres',
                                               'apellidos', 
                                               'identificacion',
                                               'telefono' ,
                                               'email',
                                               'origen',
                                               'forma_pago'
                                            )
                                            ->join("auditoria", "auditoria.cod_reg", "=", "clientes.id_cliente")
                                            ->where("auditoria.tabla", "clientes")
                                            ->where("auditoria.status", "!=", "0")
                                            ->orderBy("clientes.id_cliente", "DESC")->get();
         return $users;
    }
}
