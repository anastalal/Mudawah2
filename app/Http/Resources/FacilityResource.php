<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FacilityResource extends JsonResource
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
            'description' => $this->description,
            'owner_id' => $this->owner_id,
            'address' => $this->address,
            'image' => $this->image,
            'bg_image' => $this->bg_image,
            'parent_id' => $this->parent_id,
            'seen' => $this->seen,
            'state' => $this->state,
            'phone_number' => $this->phones,
            'clinics'=>ClinicResource::collection($this->clinics), 
            'doctorss'=>$this->doctors, 
            'devices'=>$this->devices, 
            'rates'=>$this->rates, 
            'work_days'=>WorkDaysResource::collection($this->workDays), 
            'directorate'=>$this->location,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

        
        ];
    }
}
