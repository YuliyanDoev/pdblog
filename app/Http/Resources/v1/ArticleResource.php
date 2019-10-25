<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'publisher'=>$this->user->name,
            'description'=>$this->description,
            'image'=>$this->image,
            'category'=>optional($this->category)->name,
            'image'=>$this->image,
            'created'=> $this->created_at->format('d-m-Y H:i'),
            'tags' => $this->tags->pluck('name','id')->toArray(),
            'comments' => CommentResource::collection($this->comments)
        ];
    }
}
