<?php

namespace App\Modules\Purchases\Resources;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\VendorMasters\Resources\VendorMasterResource;
use JsonException;
use App\Common\Datetime\TimeDate;

class PurchaseResource extends JsonResource
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
        $purchase = $this;
        $datetime = new TimeDate();
        return [
            'id' => $purchase->id,
            'name' => $purchase->name,
            'parent_id' => $purchase->parent_id,
            'parent_type' => $purchase->parent_type,
            'bill_no' => $purchase->bill_no,
            'bill_date' => $datetime->to_display_date($purchase->bill_date),
            'total_taxable' => $purchase->total_taxable,
            'total_tax' => $purchase->total_tax,
            'grand_total' => $purchase->grand_total,
            'vendor_name' => (new VendorMasterResource($purchase->vendors))->name??'',
            'status' => $purchase->status,
            'description' => $purchase->description,
            'date_entered' => $datetime->to_display_date_time($purchase->date_entered),
            'date_modified' => $datetime->to_display_date_time($purchase->date_modified),
        ];
    }
}
////'category_name' => (new CategoryResource($purchase->category))->name??'',