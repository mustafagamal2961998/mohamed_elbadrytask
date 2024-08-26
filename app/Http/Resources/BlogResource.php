<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'id'=>$this->id,
            'title'=>$this->title,
            'content'=>$this->content,
            'cover'=>$this->getFirstMediaUrl('cover'),
            'user'=>new UserResource($this->user),
            'comments'=>CommentResource::collection($this->comments),
            'created_at'=>$this->created_at->format('Y-m-d'),
        ];

    
    }
}
