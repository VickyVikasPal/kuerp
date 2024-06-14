<?php

namespace App\Http\Resources\SubCategory;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;

class SubCategoryResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        /** @var SubCategory $user */
        $subcategory = $this;
        
        return [
            'id' => $subcategory->id,
            'name' => $subcategory->name,
            'parent_id' => $subcategory->parent_id,
            'parent_type' => $subcategory->parent_type,
            'category_name' => (new SubCategoryResource($subcategory->subCategory))->name??'',
            'status' => $subcategory->status,
            'subcategory_image' => $subcategory->subcategory_image,
           // 'avatar' => $category->getAvatar(),
           // 'gravatar' => $category->getGravatar(),
            'created_at' => $subcategory->created_at->toISOString(),
            'updated_at' => $subcategory->updated_at->toISOString(),
            
        ];

      
    }
}
