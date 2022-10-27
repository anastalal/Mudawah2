<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\User;
use App\Models\Workday;
use App\Http\Resources\DoctorClinicsResource;
use App\Http\Resources\WorkDaysResource;
use App\Models\DoctorClinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicController extends Controller
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
    public function getClinicsFilter(Request $request){
        $doctors=Facility::where('location_id',$request->location_id
        //['location_id','=',$request->location_id],
       )->with('location')->get();
   
      // $data =  DoctorResource::collection($doctors->get());
      //return response()->json($doctors);
      return $doctors;
   
      }
      //must be deleted
   
      public function getDoctorClinics(Request $request){
          
 

        $clinics=User::find(710)->clinics;
        $workdays=array();
        foreach($clinics as $clinic){
            $workdyaSave=new Workday();
            $workdyaSave= $clinic->workDays()->with(array('periods' => function($query) {
                $query->wherePivot('doctor_id','=','710')->andWherePivot('clinic_id','=','1');}))->get();
             
              //  $workdays2=Facility::clinicPeriods($clinic->id);
              //  $workdays2=$clinic->workdays->wherePivot('clinic_id',$clinic->id)->get();
                return   [
                    'id' => $clinic->id,
                    'name' => $clinic->name,
                    'description' => $clinic->description,
                    'owner_id' => $clinic->owner_id,
                    'address' => $clinic->address,
                   // 'rates'=>$this->rates, 
                    'work_days'=>$workdyaSave, 
        
                ];
              
        }

        $workdays2=Facility::clinicPeriods(1);
        return   [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'owner_id' => $this->owner_id,
            'address' => $this->address,
           // 'rates'=>$this->rates, 
            'work_days'=>$workdays2, 

        ];
       // return DoctorClinicsResource::collection($clinics);
         

    }

    public function getDoctorClinicWOrkday(Request $request){
                /*$doctor=User::find(717);
                return $doctor->with('workday')->where('workday_id',1)->first();
                return $doctor->with(['workday',function ($query){
                   $query->wherePivot('doctor_id',717);
                }])->get();*/
               
                $doctor=User::find($request->doctor_id);
                $doctors=  User::with(['workday' =>function($query) use($request,$doctor){
                    return $query->wherePivot('doctor_id',$request->doctor_id)
                    ->wherePivot('clinic_id',$request->clinic_id)
                         ->with(['periods'=>function($query1) use($request,$doctor){
                        return $query1->wherePivot('doctor_id',$request->doctor_id)
                        ->wherePivot('clinic_id',10);
                    },
                  //  'pivot'=>$doctor->('pivot.user_id')

                ],
               
                )->get();
                }
            ])->where('id',$request->doctor_id)->first();
            $price=DoctorClinic::select('price')->where('user_id',$request->doctor_id)
            ->Where('facility_id',$request->clinic_id)->first();
            $response=response(['doctors'=>$doctors,'price'=>$price]);
                return $response;
/*
                $doctor=User::find($request->doctor_id);
                $workDays=  $doctor->workday()->with(['periods' =>function($query) use($request){
                    return $query->wherePivot('doctor_id',$request->doctor_id)
                    ->wherePivot('clinic_id',$request->clinic_id);
                  
                },
                
                
                ])->wherePivot('doctor_id',$request->doctor_id)
                ->wherePivot('clinic_id',$request->clinic_id)->get();
                return $workDays;
*/

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facility $facility)
    {
        //
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
