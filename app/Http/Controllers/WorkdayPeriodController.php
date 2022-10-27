<?php

namespace App\Http\Controllers;

use App\Http\Resources\DoctorClinicResource;
use App\Http\Resources\WorkDaysResource;
use App\Models\DoctorClinic;
use App\Models\Workday;
use App\Models\WorkdayPeriod;
use Illuminate\Http\Request;

class WorkdayPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $work_days= Workday::all();
       $data =  WorkDaysResource::collection($work_days);
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
        $work_days= WorkdayPeriod::create([
            'workday_id' => 1,
            'period_id' => $request->period_id,
            'doctor_id' => $request->doctor_id,
            'clinic_id' => $request->clinic_id
        
         ]);
       //  $workdayPeriod1=WorkdayPeriod::orderBy('id','DESC');
       $work_days= Workday::all();
        $data= WorkDaysResource::collection($work_days->where('id',$request->workday_id));

       return $data;
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
