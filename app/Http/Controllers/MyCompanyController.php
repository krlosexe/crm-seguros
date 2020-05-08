<?php

namespace App\Http\Controllers;

use App\MyCompany;
use Illuminate\Http\Request;

class MyCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MyCompany::first();

        return response()->json($data)->setStatusCode(200);


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
  
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MyCompany  $myCompany
     * @return \Illuminate\Http\Response
     */
    public function show(MyCompany $myCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MyCompany  $myCompany
     * @return \Illuminate\Http\Response
     */
    public function edit(MyCompany $myCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MyCompany  $myCompany
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $myCompany)
    {
        
        $file = $request->file('logo_file');

        if($file != null){
            $destinationPath = 'img/my_company/';
            $file->move($destinationPath,$file->getClientOriginalName());
            $request["logo"]   = $file->getClientOriginalName();
        }

        $update = MyCompany::find($myCompany)->update($request->all());

        if ($update) {
            $data = array('mensagge' => "Los datos fueron registrados satisfactoriamente");    
            return response()->json($data)->setStatusCode(200);
        }else{
            return response()->json("A ocurrido un error")->setStatusCode(400);
        }


    }

    public function Files(){
        echo "adasdsad";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MyCompany  $myCompany
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyCompany $myCompany)
    {
        //
    }
}
