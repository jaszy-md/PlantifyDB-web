<?php
namespace App\Http\Resources\Categories;

use App\Http\Resources\Plants\PlantResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'     => $this->id,
            'name'   => $this->name,
            'plants' => PlantResource::collection($this->whenLoaded('plants')),
        ];
    }
}
