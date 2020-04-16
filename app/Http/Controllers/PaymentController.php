<?php

namespace App\Http\Controllers;

use App\ChargeAccount;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    function get(Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data = ChargeAccount::select("charge_accounts.*","policies.type_clients", "policies.number_policies","policies_annexes.number_annexed", 
                    "clients_people.id_clients_people",
                                        "clients_people.names as name_client", "clients_people.last_names", "clients_people.number_document",
                                        "clients_people_contact.department","clients_people_contact.city", "branchs.name as name_branch",
                                        "clients_company_contact.department","clients_company_contact.city","datos_personales.*", 
                                        "auditoria.*", "user_registro.email as email_regis", "user_registro.firm", "clients_company.business_name", "clients_company.nit as number_document")

                                ->join("policies", "policies.id_policies", "=", "charge_accounts.id_policie", "left")
                                ->join("policies_annexes", "policies_annexes.id_policies_annexes", "=", "charge_accounts.number", "left")
                                ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients", "left")

                                ->join("clients_company", "clients_company.id_clients_company", "=", "policies.clients", "left")
                                ->join("clients_company_contact", "clients_company_contact.id_clients_company", "=", "clients_company.id_clients_company", "left")


                                ->join("clients_people_contact", "clients_people_contact.id_clients_people", "=", "clients_people.id_clients_people", "left")
                                ->join("branchs", "branchs.id_branchs", "=", "policies.branch", "left")

                                ->join("auditoria", "auditoria.cod_reg", "=", "charge_accounts.id_charge_accounts")
                                ->where("auditoria.tabla", "charge_accounts")
                                ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                                ->join('datos_personales', 'datos_personales.id_usuario', '=', 'user_registro.id')
                                ->where("auditoria.status", "!=", "0")



                                ->join("auditoria as ap", "ap.cod_reg", "=", "policies.id_policies")
                                ->where("ap.tabla", "policies")

                                ->where("ap.status", "!=", "0")





                                ->with("collections")
                              
                                ->orderBy("charge_accounts.id_charge_accounts", "DESC")
                                ->get();
           
            return response()->json($data)->setStatusCode(200);

        return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }



    function paymentsReceivable(Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data = RecibosCobranza::join("policies", "policies.id_policies", "=", "recibos_cobranza.id_policie")
                                    ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients")

                                    ->where("recibos_cobranza.status", 0)
                                    ->orderBy("recibos_cobranza.id_policie", "desc")
                                    ->orderBy("recibos_cobranza.monthly_fee", "asc")
                                    ->get();

            return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }

    }


    function paymentsBeaten(Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data = RecibosCobranza::join("policies", "policies.id_policies", "=", "recibos_cobranza.id_policie")
                                    ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients")

                                    ->where("recibos_cobranza.status", 0)
                                    ->where("recibos_cobranza.payment_date", "<", date("Y-m-d"))
                                    ->orderBy("recibos_cobranza.id_policie", "desc")
                                    ->orderBy("recibos_cobranza.monthly_fee", "asc")
                                    ->get();

            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }

    }

    function paymentsCollected(Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data = RecibosCobranza::join("policies", "policies.id_policies", "=", "recibos_cobranza.id_policie")
                                    ->join("clients_people", "clients_people.id_clients_people", "=", "policies.clients")

                                    ->where("recibos_cobranza.type_operation", "A")
                                    ->orderBy("recibos_cobranza.id_policie", "desc")
                                    ->orderBy("recibos_cobranza.monthly_fee", "asc")
                                    ->get();

            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }

    }

    

    function GetByPolicie(Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data = RecibosCobranza::where("id_policie", $request->id_policie)
                                    ->orderBy("recibos_cobranza.monthly_fee", "asc")
                                    ->get();
            
            return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }



    function FeePending(Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $fees = RecibosCobranza::selectRaw("recibos_cobranza.*")
                                     ->where("status", 0)
                                     ->where("id_policie", $request->id_policie)
                                     ->orderBy('recibos_cobranza.monthly_fee', 'asc')
                                     ->get();

           
            if (sizeof($fees) > 0) {

                $fees_array = $fees;
                $data   = array();
               
                $min_recibo    =  $fees_array[0];
                
                $id_min_recibo =  $fees_array[0]["monthly_fee"];

                $data["fee_pending"] = $min_recibo;

                foreach ($fees as $value) {
                    if ($id_min_recibo > $value["monthly_fee"]) {
                        $data["fee_pending"] = $value;
                    }
                }


                $balance         = $this->GetBalance($request["id_policie"]);
                $data["balance"] = $balance[0]["balance"];
                
                return response()->json($data)->setStatusCode(200);
            }else{
                return response()->json("1")->setStatusCode(200);
            }
           

        }else{

            return response()->json("No esta autorizado")->setStatusCode(400);

        }
    }



    function GetBalance($id_policie){
        $data = RecibosCobranza::selectRaw("sum(balance) as balance")
                                 ->where("id_policie", $id_policie)
                                 ->where("status", 0)->get();
        
        return $data;
    }

    function PaymentFee(Request $request){

        
        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $request["type_operation"]  = "A";
            $request["payment"]         = (float) str_replace(',', '', $request["payment"]);
            $request["amount"]          = (float) str_replace(',', '', $request["amount"]);

            $next_payment = $request["amount"] - $request["payment"];

            if($next_payment <= 0){
                $request["status"]  = 1;
                $request["balance"] = 0;
            }else{
                $request["status"]  = 0;
                $request["balance"] = $next_payment;
            }

           
            RecibosCobranza::create($request->all());
            RecibosCobranza::find($request["id_recibos_cobranza"])->update(["status" => 1]);

            if($next_payment < 0){

                $fee_pending = $this->FeePending($request);

                $fee_pending->original["fee_pending"]->payment = abs($next_payment);
                $fee_pending->original["fee_pending"]->payment_date = $request["payment_date"];

                $request["payment"]             = abs($next_payment);
                $request["id_recibos_cobranza"] = $fee_pending->original["fee_pending"]->id_recibos_cobranza;
                $request["amount"]              = $fee_pending->original["fee_pending"]->balance;
                $request["monthly_fee"]         = $fee_pending->original["fee_pending"]->monthly_fee;
                
                $this->PaymentFee($request);

            }
           
            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);

        }else{

            return response()->json("No esta autorizado")->setStatusCode(400);

        }
    }

}