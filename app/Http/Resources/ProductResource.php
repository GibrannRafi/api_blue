<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'store_id' => new StoreResource($this->store),
            'product_category' => new ProductCategoryResource($this->product_category),
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'condition' => $this->condition,
            'price' => (float) (string) $this->price,
            'weight' => $this->weight,
            'stock' => $this->stock,
            'product_images' => $this->productImages
            ];
    }
}
