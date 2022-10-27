<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
       $rate=  Rate::create([
            'user_id' => $request->user()->id,
            'doctor_id' => $request->doctor_id,
            'facility_id' => $request->clinic_id,
            'stars_number' => $request->stars_number,
            'comment' => $request->comment,
        ]);
        return $rate;
        
        $doctor=User::find($request->doctor_id);
        
        $ratesCount=Rate::where('doctor_id',$request->doctor_id)->count();
        $ratevalues=Rate::where('doctor_id',$request->doctor_id)->avg('stars_number');

     $ratevaluesA=round($ratevalues, 2);

       
      //  return $sum;
       $doctor->rate_average=$ratevaluesA;
       
        $doctor->save();
        return $doctor->rate_average;

        /*$rate_avarage_after_update=
        if($request->has('clinic_id')){
            $facility=Facility::find($request->clinic_id);
            $facility->rate_avarage=

        }*/
        //$doctor=User::find($request->doctor_id);
        //$rate=$doctor->rate_average;
        


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
