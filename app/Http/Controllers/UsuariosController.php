<?php

namespace App\Http\Controllers;

use App\User;
use App\Auditoria;
use App\datosPersonaesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])) {


            ini_set('memory_limit', '-1');

            
            $User = User::select("users.*", "datos_personales.*", "roles.nombre_rol", "auditoria.status", "auditoria.fec_regins", "user_registro.email as user_registro")
                          ->join('datos_personales', 'datos_personales.id_usuario', '=', 'users.id')
                          ->join("auditoria", "auditoria.cod_reg", "=", "users.id")
                          ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                          ->join("roles", "roles.id_rol", "=", "users.id_rol")
                          ->where("auditoria.tabla", "users")
                          ->where("auditoria.status", "!=", "0")
                          ->orderBy("users.id", "desc")

                          ->with("logs")
                          ->with("logsSessiones")

                         
                          ->get();
            
            return response()->json($User)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    public function GetUsersTasks(Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])) {
            $User = User::select("users.*", "datos_personales.*", "roles.nombre_rol", "auditoria.status", "auditoria.fec_regins", "user_registro.email as user_registro")
                          ->join('datos_personales', 'datos_personales.id_usuario', '=', 'users.id')
                          ->join("auditoria", "auditoria.cod_reg", "=", "users.id")
                          ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                          ->join("roles", "roles.id_rol", "=", "users.id_rol")
                          ->where("auditoria.tabla", "users")
                          ->where("users.id_rol", "!=", 18)
                          ->where("auditoria.status", "!=", "0")
                          ->orderBy("users.id", "desc")
                          ->get();
            
            return response()->json($User)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    public function GetAsesoras(Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])) {
            $User = User::select("users.*", "datos_personales.*", "roles.nombre_rol", "auditoria.status", "auditoria.fec_regins", "user_registro.email as user_registro")
                          ->join('datos_personales', 'datos_personales.id_usuario', '=', 'users.id')
                          ->join("auditoria", "auditoria.cod_reg", "=", "users.id")
                          ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                          ->join("roles", "roles.id_rol", "=", "users.id_rol")
                          ->where("roles.nombre_rol", "Asesor")
                          ->where("auditoria.tabla", "users")
                          ->where("auditoria.status", "!=", "0")
                          ->orderBy("users.id", "desc")
                          ->get();
            
            return response()->json($User)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $messages = [
                'required' => 'El Campo :attribute es requirdo.',
            ];


            $validator = Validator::make($request->all(), [
                'img-profile'     => 'required',
                'email'           => 'required',
                'password'        => 'required',
                'repeat-password' => 'required',
                'rol'             => 'required'

            ], $messages);  



            if ($request["password"] != $request["repeat-password"]) {
                return response()->json("Las contrasenas no coinciden")->setStatusCode(400);
            }

            if ($validator->fails()) {
                return response()->json($validator->errors())->setStatusCode(400);

            }else{

               $userExist = User::where('email', $request->email)
                                  ->join("auditoria", "auditoria.cod_reg", "=", "users.id")
                                  ->where("auditoria.tabla", "users")
                                  ->where("auditoria.status", "!=", "0")
                                  ->first();

                if($userExist != null){
                  return response()->json("El usuario ya se encuentra registrado")->setStatusCode(400);
                }

                $file = $request->file('img-profile');

                $destinationPath = 'img/usuarios/profile';
                $file->move($destinationPath,$file->getClientOriginalName());

               
                $User              = new User;
                $User->email       = $request["email"];
                $User->password    = md5($request["password"]);
                $User->img_profile = $file->getClientOriginalName();
                $User->id_rol      = $request["rol"];
                
                $User->save();


                $datos_personales                   = new datosPersonaesModel;
                $datos_personales->nombres          = $request["nombres"];
                $datos_personales->apellido_p       = $request["apellido_p"];
                $datos_personales->apellido_m       = $request["apellido_m"];
                $datos_personales->n_cedula         = $request["n_cedula"];
                $datos_personales->fecha_nacimiento = $request["fecha_nacimiento"];
                $datos_personales->telefono         = $request["telefono"];
                $datos_personales->direccion        = $request["direccion"];
                $datos_personales->id_usuario       = $User->id;
                $datos_personales->save();


                $auditoria              = new Auditoria;
                $auditoria->tabla       = "users";
                $auditoria->cod_reg     = $User->id;
                $auditoria->status      = 1;
                $auditoria->usr_regins  = $request["id_user"];
                $auditoria->save();

                if ($User) {
                    $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
                    return response()->json($data)->setStatusCode(200);
                }else{
                    return response()->json("A ocurrido un error")->setStatusCode(400);
                }
            }
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $User = User::select("users.*", "datos_personales.*", "roles.nombre_rol", "auditoria.status", "auditoria.fec_regins", "user_registro.email as user_registro")
                          ->join('datos_personales', 'datos_personales.id_usuario', '=', 'users.id')
                          ->join("auditoria", "auditoria.cod_reg", "=", "users.id")
                          ->join("users as user_registro", "user_registro.id", "=", "auditoria.usr_regins")
                          ->join("roles", "roles.id_rol", "=", "users.id_rol")
                          
                          ->where("users.id", $id)
                          ->where("auditoria.tabla", "users")
                          ->where("auditoria.status", "!=", "0")
                          ->orderBy("users.id", "desc")
                          
                          ->first();
        
        return response()->json($User)->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "STRING";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            
            $messages = [
                'required' => 'El Campo :attribute es requirdo.',
                'unique'   => 'El Campo :attribute ya se encuentra en uso.'
            ];


            $validator = Validator::make($request->all(), [
                //'email'           => 'required|unique:users',
                //'rol'             => 'required'

            ], $messages); 
            

            if($request["password"] != "" || $request["repeat-password"] != ""){

                if ($request["password"] != $request["repeat-password"]) {
                    return response()->json("Las contrasenas no coinciden")->setStatusCode(400);
                }

            }
            

            if ($validator->fails()) {
                return response()->json($validator->errors())->setStatusCode(400);
            }else{


                $firm = $request->file("firm");
                
                
                $file = $request->file('img-profile');
                

                $User = User::find($id);


                if(isset($request["email"])){
                    $User->email  = $request["email"];
                }


                if(isset($request["rol"])){
                    $User->id_rol = $request["rol"];
                }
                
                if($file != null){
                    $destinationPath = 'img/usuarios/profile';
                    $file->move($destinationPath,$file->getClientOriginalName());
                    $User->img_profile = $file->getClientOriginalName();
                }

               
               
                if($firm != null){
                    $destinationPath = 'img/usuarios/firms';
                    $firm->move($destinationPath,$firm->getClientOriginalName());
                    $User->firm = $firm->getClientOriginalName();
                }


                if($request["password"] != "" && $request["repeat-password"] != ""){
                    $User->password = md5($request["password"]);
                }



                $User->save();

                $datos_personales = datosPersonaesModel::where("id_usuario", $id)->first();

                if($request["nombres"]){
                    $datos_personales->nombres          = $request["nombres"];
                    $datos_personales->apellido_p       = $request["apellido_p"];
                    $datos_personales->apellido_m       = $request["apellido_m"];
                    $datos_personales->n_cedula         = $request["n_cedula"];
                    $datos_personales->fecha_nacimiento = $request["fecha_nacimiento"];
                   

                    if($request["telefono"]){
                        $datos_personales->telefono         = $request["telefono"];
                    }
                   


                    $datos_personales->direccion        = $request["direccion"];
                }
                

                $datos_personales->save();

                $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
                return response()->json($data)->setStatusCode(200);

            }

        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
        
    }


    public function statusUser($id_user, $status, Request $request)
    {
        if ($this->VerifyLogin($request["id_user"],$request["token"])){
            $countRegisters = Auditoria::where("usr_regins", $id_user)->where("status", 1)->get()->count();

            if($countRegisters > 0 && $status == 0){
              return response()->json("El usuario tiene registros dentro de la plataforma, no se puede eliminar")->setStatusCode(400);
            }

            $auditoria = Auditoria::where("cod_reg", $id_user)->where("tabla", "users")->first();

            $auditoria->status = $status;

            if($status == 0){
                $auditoria->usr_regmod = $request["id_user"];
                $auditoria->fec_regmod = date("Y-m-d");
            }

            $auditoria->save();

            if($status == 0){
              
              User::find($id_user)->delete();

              $mensaje = 'El usuario fue eliminado correctamente';
            }
            else{
              $mensaje = 'Los datos fueron actualizados satisfactoriamente';
            }


            $data = array('mensagge' => $mensaje);    
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("No esta autorizado")->setStatusCode(400);
        }
    }



    public function LastConnection($id_user){
        User::where("id", $id_user)->update([
            "last_connection" => date("Y-m-d G:i:s")
        ]);

        $data = array('mensagge' => "Los datos fueron actualizados satisfactoriamente");    
        return response()->json($data)->setStatusCode(200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
