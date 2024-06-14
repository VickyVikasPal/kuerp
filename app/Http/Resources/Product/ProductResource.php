<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Http\Resources\Taxtype\TaxtypeResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

    class ProductResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        /** @var Product $user */
        $product = $this;
       
        return [
            'id' => $product->id,
            'parent_id' => $product->parent_id,
            'parent_type' => $product->parent_type,
            'category_name' => (new CategoryResource($product->categoryResource))->name??'',
            'subcategory_id' => $product->subcategory_id,
            'subcategory_name' => (new SubCategoryResource($product->subCategoryResource))->name??'',
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            //'status' => (bool) $product->status,
            'status' => $product->status,
            'avatar' => $product->getAvatar(),
            'gravatar' => $product->getGravatar(),
            'created_at' => $product->created_at->toISOString(),
            'updated_at' => $product->updated_at->toISOString(),
            'foodradio' => $product->foodradio,
            'foodtype' => $product->foodtype,
            'message' => $product->message,
            'foodselect' => $product->foodselect,
            'date' => gmdate($product->date),
            'product_image'=>$product->product_image,
            'taxtype_id'=>$product->taxtype_id,
            'tax_rate'=>(new TaxtypeResource($product->taxtypeResource))->tax??'',
        ];

      
    }
}
