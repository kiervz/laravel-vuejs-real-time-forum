<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'path' => $this->path,
            'body' => $this->body,
            'replies' => ReplyResource::collection($this->replies),
            'reply_count' => $this->replies->count(),
            'category' => $this->category->name,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'user_path' => $this->user->path,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
