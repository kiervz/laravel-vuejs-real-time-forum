<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'replyBy' => $this->data['replyBy'],
            'reply' => $this->data['reply'],
            'reply_id' => $this->data['reply_id'],
            'path' => $this->data['path'],
            'created_at' => $this->created_at->format('F j - h:i A')
        ];
    }
}
