<?php

namespace App\Http\Resources\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        /** @var Category $user */
        $category = $this;
        
        return [
            'id' => $category->id,
            'name' => $category->name,
            'status' => $category->status,
            'category_image' => $category->category_image,
           // 'avatar' => $category->getAvatar(),
           // 'gravatar' => $category->getGravatar(),
            'created_at' => $category->created_at->toISOString(),
            'updated_at' => $category->updated_at->toISOString(),
            
        ];

      
    }
}
