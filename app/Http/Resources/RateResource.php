<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            // 'doctor' => $this->doctor->name,
           // 'clinic' => $this->clinic->name,
            'stars_number' => $this->stars_number,
            'comment' => $this->comment,
           ];
    }
}
