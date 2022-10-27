<?php

namespace App\Http\Controllers;

use App\Models\Specializition;
use Illuminate\Http\Request;
use App\Http\Resources\SepcializitionResource;

class SpecializitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $sp = Specializition::orderBy('created_at', 'DESC')->get();
        $sp = Specializition::orderBy('created_at', 'DESC')->get();
        //$data =  SepcializitionResource::collection($sp->get());
        return $sp;
        $data = SepcializitionResource::collection($sp);
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        return Specializition::create([
            'name' => $request->name,
            'desctiprion' => 'sasdfadsf'  
            
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
