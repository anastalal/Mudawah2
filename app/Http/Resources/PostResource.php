<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'categories' => $this->categories,
            'user_id' => $this->user_id,
            'user_data' => $this->user,
            'likes' => $this->likes->where('likeable_type','like'),
            'seen' => $this->seen,
            'image' => $this->featured_image,
            'created_at' => date('Y-m-d',  strtotime($this->created_at)),
            'comments'=>CommentResource::collection($this->comment),
        ];

    }
}
