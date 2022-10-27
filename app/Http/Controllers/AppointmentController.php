<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::whereNotNull('id');

        if (isset($_GET['id'])) {
            $appointments->where('id', $_GET['id']);
        }

        if (isset($_GET['user_id'])) {
            $appointments->where('user_id', $_GET['user_id']);
        }

        if (isset($_GET['doctor_id'])) {
            $appointments->where('doctor_id', $_GET['doctor_id']);
        }

        
        return AppointmentResource::collection($appointments->get());
    }
 
    //getting appointments of the authinticated user
    public function getUserAppointments(Request $request){

            $appointments=Appointment::where('user_id',$request->user()->id);

        $data= AppointmentResource::collection($appointments->get());
        return $data;

    }
      
    //getting the periods of a specific doctor
    public function checkAppointedPeriods(Request $request){
        $appointments = Appointment::select('time')->where('doctor_id',$request->doctor_id)
        ->where('clinic_id',$request->clinic_id)->where('workday_id',$request->workday_id)->get();
        return $appointments;
    }
      
      //getting the appointments work of a specific doctor
    public function getDoctorAppointments(Request $request){
        $appointments=Appointment::where('user_id',$request->user()->id);
        $data= AppointmentResource::collection($appointments->get());
        return $data;

        
    }

    public function updateAppointmentState(Request $request){
        $appointment_id=$request->appointment_id-50;
        $appointment=Appointment::find($appointment_id);
        
        $appointment->state_id=$request->state_id;
        $appointment->save();
       // $data= new AppointmentResource($appointment->get());
        return [
            'id' => $appointment->id+50,
            'patient_name' => $appointment->patient_name,
            'patient_age' => $appointment->patient_age,
            'patient_phone' => $appointment->patient_phone,
            'is_first_time' => $appointment->is_first_time,
            'note' => $appointment->note,
            'price' => $appointment->price,
            'time' => $appointment->time,
            'doctor' => $appointment->doctor,
            'clinic' => $appointment->clinic,        
            'date' => $appointment->date,
            'state' => $appointment->state,

        ];
         
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
       return  Appointment::create([
            'user_id' => $request->user()->id,
            'doctor_id' => $request->doctor_id,
            'clinic_id' => $request->clinic_id,
            'workday_id' =>3,
            'time' => $request->time,
            'price' => $request->price,
            'state_id' => $request->state_id,
            'patient_name' => $request->patient_name,
            'patient_age' => $request->age,
            'is_first_time' => $request->is_first_time,
            'note' => $request->note,
            'date' => $request->date,
            'state_id' => $request->state_id,
            
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
