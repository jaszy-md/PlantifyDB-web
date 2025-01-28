<?php

namespace App\Http\Resources\Plants;

use App\Http\Resources\Categories\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PlantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'           => $this->id,
            'image_url'    => $this->image_url,
            'name'         => $this->name,
            'information'  => $this->information,
            'category'     => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}
