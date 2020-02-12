<?php

namespace App\Http\Controllers;

use App\Footers;
use Illuminate\Http\Request;

class FootersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Footers::get();
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
        Footers::create($request->all());

        return response()->json("ok")->setStatusCode(200);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Footers  $footers
     * @return \Illuminate\Http\Response
     */
    public function show(Footers $footers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Footers  $footers
     * @return \Illuminate\Http\Response
     */
    public function edit(Footers $footers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Footers  $footers
     * @return \Illuminate\Http\Response
     */
    public function update($request)
    {
        Footers::where('name', $request["name"])->update($request->all());

        return response()->json("ok")->setStatusCode(200);

    }


    public function updateFooter(Request $request)
    {
        Footers::where('name', $request["name"])->update($request->all());
        return response()->json("ok")->setStatusCode(200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Footers  $footers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Footers $footers)
    {
        //
    }
}
