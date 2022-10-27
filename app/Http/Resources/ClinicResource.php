<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClinicResource extends JsonResource
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
            'doctors'=>$this->doctors, 
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        
        ];
    }
}
