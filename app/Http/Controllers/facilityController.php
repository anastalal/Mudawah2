<?php

namespace App\Http\Controllers;

use App\Http\Resources\FacilityResource;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Facility;
use Illuminate\Http\Request;

class facilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    
    public function getHospitals(Request $request)
    {
        $facilities = Facility::orderBy('seen', 'DESC');

        $data =  FacilityResource::collection($facilities->get());

        return $data;
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
        $fileName_image = '';
        if (isset($request->image) && $request->image != null) {
            $name =   Str::random(15) . '.jpg';
            // decode the base64 file 
            $file = base64_decode(
                $request->image
            );
            Storage::put('public/posts/'  .  $name,   $file);
            file_put_contents(public_path() . '/storage/posts/' . $name, $file);
            $fileName_image = 'posts/' . $name;
        }
        $fileName_bgImage = '';
        if (isset($request->bg_image) && $request->bg_image != null) {
            $name =   Str::random(15) . '.jpg';
            // decode the base64 file 
            $file = base64_decode(
                $request->bg_image
            );
            
            Storage::put('public/posts/'  .  $name,   $file);
            file_put_contents(public_path() . '/storage/posts/' . $name, $file);
            $fileName_bgImage = 'posts/' . $name;
        }


        return Facility::create([
            'name' => $request->name,
            'description' => $request->description,
            'owner_id' => $request->user()->id,
            'address' => $request->address,
            'parent_id' => $request->parent_id,
            'image' => $fileName_image,
            'bg_image' => $fileName_bgImage,
            'type' => $request->type,
            'location_id' => $request->location_id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $facility = Facility::find($$request->id);

        if (isset($request->name) && $request->name) {
            $facility->name = $request->name;
        }

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        //
    }
}
