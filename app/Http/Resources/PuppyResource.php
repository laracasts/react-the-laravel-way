<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PuppyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'trait' => $this->trait,
            'imageUrl' => $this->image_url,
            'likedBy' => UserResource::collection($this->whenLoaded('likedBy'))->pluck('id'),
            'user' => UserResource::make($this->whenLoaded('user'))
        ];
    }
}
