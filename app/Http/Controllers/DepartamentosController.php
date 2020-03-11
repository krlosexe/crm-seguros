<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamentos;
use App\Municipios;

class DepartamentosController extends Controller
{
    public function get(){
        $data = Departamentos::get();
        return response()->json($data)->setStatusCode(200);
    }

    public function getMunicipios($id){
        $data = Municipios::where("departamento_id", $id)->get();
        return response()->json($data)->setStatusCode(200);
    }
}
