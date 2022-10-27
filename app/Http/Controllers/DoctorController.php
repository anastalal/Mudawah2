<?php

namespace App\Http\Controllers;

use App\Http\Resources\DoctorResource;
use App\Http\Resources\FacilityResource;
use App\Models\Facility;
use App\Models\Role;
use App\Models\Specializition;
use App\Models\User;
use Illuminate\Http\Request;
//use TCG\Voyager\Models\Role;

class DoctorController extends Controller
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

    public function getAllDoctors(){
        $doctors=User::where('role_id',5)->get();
        return DoctorResource::collection($doctors);
        
    }
    public function getDoctorsByRate(){
        $doctors=User::where('role_id',5)->orderBy('rate_average')->get();
        
        return DoctorResource::collection($doctors);
    }

    public function getDoctorsBySpec(){
        $doctors=User::where('role_id',5)->orderBy('rate_average')->get();
      //  $doctors=Specializition->
        return DoctorResource::collection($doctors);
    }



    public function doctorsFilter(Request $request)
    {
       //return 'hi othman , you can do it';
        if($request->type=='h'){
            if($request->location_id==-1){
                $hospitals = Facility::all()->where('type','h');
                $data= FacilityResource::collection($hospitals);
                return $data;
            }
            else{
                $hospitals = Facility::where(
                    'location_id',
                    $request->location_id
                )->where('type','h')->get();
                $data= FacilityResource::collection($hospitals);
                return $data;
            }
       
        }
        //getting clinics filter
        else if($request->type=='c'){
            if($request->location_id==-1){
                $clinics = Facility::all()->where('type','c');
                $data= FacilityResource::collection($clinics);
                return $data;
            }else{
                $clinics = Facility::where(
                    'location_id',
                    $request->location_id
                )->where('type','c')->get();
                $data= FacilityResource::collection($clinics);
                return $data;
            }
       
        }
        else{
            $clinics=null;
         
            if($request->location_id==-1){
                $clinics = Facility::all();
            }
            else{
                $clinics = Facility::where(
                    'location_id',
                    $request->location_id
                   
                )->where('type','c')->get();
               
            }
            
    
    
           // return $clinics;
             
             
       
        
        
          //return $role->doctors();
            
            $spe=Specializition::find($request->spec_id);
           
            $doctorsArray = array();
          //  return $spe->doctors()->get();
            $count = 0;
           
            foreach ($clinics as $clinic) {
                
                 return  $clinic;
             foreach ($clinic->doctors as $key => $value) {
               // $doc=  $value
               // ->specializitions()
               // ->wherePivot('specializition_id',1)->get();
               
              $doc=  $spe
               ->doctors()
                ->wherePivot('doctor_id',717)->first();
                
                    $spDoctors = $value->specializitions;
                    $doctorsArray[$count]=$doc;
                    
                    $count++;
                  //  return $doc;
                }
           }
           //return $doctorsArray;
           return $doctorsArray;
            $data =  DoctorResource::collection($doctorsArray);
           return $data;
            //return DoctorResource::collection($doctorsArray);
    
    
        }
       



        // $data =  DoctorResource::collection($doctors->get());
        //return response()->json($doctors);
        // return $data;
        //$doctorsIn=array();
        // $doctor=new User();
        //  $doctorsArray[$count]=$doctor;
        //  $count++;
        // $doctors2=$doctors1->specializitions()->wherePivot('specializition_id',1)->get();
        //return $doctorsArray;
        //  $doctors1=$doctors->clinic->wherePivot('specializition_id','=','spec_id')->get();
        // $doctors2=$doctors1->specializitions()->wherePivot('specializition_id',1)->get();




               //      $doctorsSpe= $clinic->doctors->specializitions->wherePivot('specializition_id',1)->get();            //['location_id','=',$request->location_id],
            //    return $doctorsSpe;
            // $doctors1= $clinic->with('doctors')->get();
            //  return $doctors1;
            // $data =  DoctorResource::collection($doctors1);
          
   // return $spDoctors;
            // foreach ($doctors1 as $doctor) {
            //     $data = new DoctorResource($doctor);
            //     // return $data;

            //     array_push($doctorsArray, $doctor);
            // }
    }


    function array_add_multiple($array, $items)
    {
        foreach ($items as $key => $value) {
            //  $array = array_add($items, $key, $value);
        }

        return $array;
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
