<?php

namespace App\Http\Controllers;

use App\ChargeAccount;
use App\RecibosCobranza;
use App\ChargeManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    function get(Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data = ChargeManagement::select('charge_accounts_management.*', 'audi.*',
                                        DB::raw("cast(audi.fec_regins as date) as fec_regins"),
                                        "clients_people.id_clients_people",
                                        "clients_people.names as name_client", 
                                        "clients_people.last_names", 
                                        "clients_people.number_document",
                                        "clients_company.id_clients_company",
                                        "clients_company.business_name",
                                      )
                                    ->join("auditoria as audi", "audi.cod_reg", "=", "charge_accounts_management.id")
                                    ->join("users as user_registro", "user_registro.id", "=", "audi.usr_regins")
                                    ->join("clients_people", "clients_people.id_clients_people", "=", "charge_accounts_management.id_client", "left")
                                    ->join("clients_company", "clients_company.id_clients_company", "=", "charge_accounts_management.id_client", "left")

                                    ->where("audi.tabla", "=", "charge_accounts_management")
                                    ->where("audi.status", "!=", "0")
                                
                                    ->with('chargeAccount')
                                    ->orderBy("charge_accounts_management.id", "DESC")
                                    ->get();


            return response()->json($data)->setStatusCode(200);

        return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    function getId(Request $request, $id){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data = ChargeManagement::select('charge_accounts_management.*', 'audi.*',
                                        "clients_people.id_clients_people",
                                        "clients_people.names as name_client", 
                                        "clients_people.last_names", 
                                        "clients_people.number_document",
                                        "clients_company.id_clients_company",
                                        "clients_company.business_name",
                                        "clients_company.nit",
                                        "datos_personales.nombres as nombre_p",
                                        "datos_personales.apellido_p",
                                        "user_registro.firm",
                                      )
                                    ->join("auditoria as audi", "audi.cod_reg", "=", "charge_accounts_management.id")
                                    ->join("users as user_registro", "user_registro.id", "=", "audi.usr_regins")
                                    ->join("datos_personales", "datos_personales.id_usuario", "=", "audi.usr_regins")
                                    ->join("clients_people", "clients_people.id_clients_people", "=", "charge_accounts_management.id_client", "left")
                                    ->join("clients_company", "clients_company.id_clients_company", "=", "charge_accounts_management.id_client", "left")
        
                                    ->where("audi.tabla", "=", "charge_accounts_management")
                                    ->where("audi.status", "!=", "0")
                                    ->where('charge_accounts_management.id', $id)

                                    ->with(['chargeAccount', 'client', 'company'])

                                    ->orderBy("charge_accounts_management.id", "DESC")
                                    ->first();


            return response()->json($data)->setStatusCode(200);

        return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }



    // cuentas por cobrar
    function paymentsReceivable(Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data = ChargeManagement::select('charge_accounts_management.*', 'audi.*',
                                        DB::raw("cast(audi.fec_regins as date) as fec_regins"),
                                        "clients_people.id_clients_people",
                                        "clients_people.names as name_client", 
                                        "clients_people.last_names", 
                                        "clients_people.number_document",
                                        "clients_company.id_clients_company",
                                        "clients_company.business_name",
                                      )
                                    ->join("auditoria as audi", "audi.cod_reg", "=", "charge_accounts_management.id")
                                    ->join("users as user_registro", "user_registro.id", "=", "audi.usr_regins")
                                    ->join("clients_people", "clients_people.id_clients_people", "=", "charge_accounts_management.id_client", "left")
                                    ->join("clients_company", "clients_company.id_clients_company", "=", "charge_accounts_management.id_client", "left")

                                    ->where("audi.tabla", "=", "charge_accounts_management")
                                    ->where("audi.status", "!=", "0")
                                    ->where("charge_accounts_management.status", 0)
                                    ->where("charge_accounts_management.limit_date", ">", date("Y-m-d"))

                                    ->with('chargeAccount')
                                    ->orderBy("charge_accounts_management.id", "DESC")
                                    ->get();

            return response()->json($data)->setStatusCode(200);

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }

    }

    // cuentas vencidas
    function paymentsBeaten(Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data = ChargeManagement::select('charge_accounts_management.*', 'audi.*',
                                        DB::raw("cast(audi.fec_regins as date) as fec_regins"),
                                        "clients_people.id_clients_people",
                                        "clients_people.names as name_client", 
                                        "clients_people.last_names", 
                                        "clients_people.number_document",
                                        "clients_company.id_clients_company",
                                        "clients_company.business_name",
                                      )
                                    ->join("auditoria as audi", "audi.cod_reg", "=", "charge_accounts_management.id")
                                    ->join("users as user_registro", "user_registro.id", "=", "audi.usr_regins")
                                    ->join("clients_people", "clients_people.id_clients_people", "=", "charge_accounts_management.id_client", "left")
                                    ->join("clients_company", "clients_company.id_clients_company", "=", "charge_accounts_management.id_client", "left")

                                    ->where("audi.tabla", "=", "charge_accounts_management")
                                    ->where("audi.status", "!=", "0")
                                    ->where("charge_accounts_management.status", 0)
                                    ->where("charge_accounts_management.limit_date", "<", date("Y-m-d"))

                                    ->with('chargeAccount')
                                    ->orderBy("charge_accounts_management.id", "DESC")
                                    ->get();

            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }

    }

    // pagos recaudados
    function paymentsCollected(Request $request){

        if ($this->VerifyLogin($request["id_user"],$request["token"])){

            $data = ChargeManagement::select('charge_accounts_management.*', 'audi.*',
                                        DB::raw("cast(audi.fec_regins as date) as fec_regins"),
                                        "clients_people.id_clients_people",
                                        "clients_people.names as name_client", 
                                        "clients_people.last_names", 
                                        "clients_people.number_document",
                                        "clients_company.id_clients_company",
                                        "clients_company.business_name",
                                      )
                                    ->join("auditoria as audi", "audi.cod_reg", "=", "charge_accounts_management.id")
                                    ->join("users as user_registro", "user_registro.id", "=", "audi.usr_regins")
                                    ->join("clients_people", "clients_people.id_clients_people", "=", "charge_accounts_management.id_client", "left")
                                    ->join("clients_company", "clients_company.id_clients_company", "=", "charge_accounts_management.id_client", "left")

                                    ->where("audi.tabla", "=", "charge_accounts_management")
                                    ->where("audi.status", "!=", "0")
                                    ->where("charge_accounts_management.status", 1)

                                    ->with('chargeAccount')
                                    ->orderBy("charge_accounts_management.id", "DESC")
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