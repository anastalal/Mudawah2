<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'role_id' => $this->role_id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'avatar' => $this->avatar,
            'imgages' => $this->imgages,
            'likes' => $this->likes,
            'description' => $this->description,
            'followers' => $this->followers,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'seen' => $this->seen,
            'phone_number' => $this->phone,
            'specializitions' => $this->specializitions,
            'clinics' => $this->clinics,
            'rates'=>$this->rates, 
            'posts'=>$this->post,
            'rate_average'=>$this->rate_average
            
        ];
    }
}
