<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      /*  return [
            'id' => $this->id,
            'doctor' => $this->doctor,
            'clinic' => $this->clinic,
            'period' => $this->workday_period,
            'price' => $this->price,
            'state' => $this->state,
            'time' => $this->time,
            'patient_name' => $this->patient_name,
            'patient_age' => $this->patient_age,
            'patient_phone' => $this->patient_phone,
            'is_first_time' => $this->is_first_time,
            'note' => $this->note,
        ];
        */

        return [
            'id' => $this->id+50,
            'patient_name' => $this->patient_name,
            'patient_age' => $this->patient_age,
            'patient_phone' => $this->patient_phone,
            'is_first_time' => $this->is_first_time,
            'note' => $this->note,
            'price' => $this->price,
            'time' => $this->time,
            'doctor' => $this->doctor,
            'clinic' => $this->clinic,        
            'date' => $this->date,
            'state' => $this->state,

        ];
    }
}
