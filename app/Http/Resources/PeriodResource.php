<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeriodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return   [
            'id' => $this->id,
            'name' => $this->name,
            'from_time' => $this->from_time,
            'to_time' => $this->to_time,
            'created_at' => $this->to_time,
            'updated_at' => $this->to_time,
        //      'doctor_clinic' => $this->doctor_clinic
             
            
        ]; 
    }
}
