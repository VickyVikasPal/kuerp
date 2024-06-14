<?php

namespace App\Modules\Products\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Categorys\Resources\CategoryResource;
use JsonException;
use App\Common\Datetime\TimeDate;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     * @throws JsonException
     */
    public function toArray($request)
    {
        $products = $this;
        $datetime = new TimeDate();
        return [
            'id' => $products->id,
            'category_name' => (new CategoryResource($products->category))->name??'',
            'name' => $products->name,
            'parent_id' => $products->parent_id,
            'parent_type' => $products->parent_type,
           'product_brand' => $products->brand_name,
           'product_code' => $products->product_code,
           'product_name' => $products->product_name,
           'product_qty' => $products->product_qty,
           'product_unit' => $products->product_unit,   
           'hsn_code' => $products->hsn_sac_code,
           'tax_type' => $products->tax_type,
           'taxable_price' => $products->taxable_price,
           'cgst' => $products->cgst,
           'sgst' => $products->sgst,
            'igst' => $products->igst,
           'unit_price' => $products->unit_price,
            'status' => $products->status,
            'description' => $products->description,
            'date_entered' => $datetime->to_display_date_time($products->date_entered),
        ];
    }
}
