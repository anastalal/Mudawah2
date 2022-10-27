<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkDaysResource extends JsonResource
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
            'code' => $this->code,
            'periods' => PeriodResource::collection($this->periods),
            'doctor_clinic' => $this->doctor_clinic
             
            
        ]; 
       }
}
