<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource
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
            'description' => $this->description,
            'user_id' => $this->user_id,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d/m/Y h:i:s'),
            'updated_at' => $this->updated_at->format('d/m/Y h:i:s'),
        ];
    }
}
