<?php

namespace App\Modules\Quotations\Resources;

use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\ClientMasters\Resources\ClientMasterResource;
use JsonException;
use App\Common\Datetime\TimeDate;
use App\Common\Utils;
use Illuminate\Support\Facades\Auth;
use DB;

class QuotationResource extends JsonResource
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
        $quotation = $this;
        $datetime = new TimeDate();
        $item_data = "";
        $autoGenerate = new Utils();
        $user = Auth::user();

        $options = array('tableName'=> $quotation->table, 'branch_id'=>$user->branch_id);

        $prefix = $autoGenerate->autoGeneratePrefix($options);

        $item_data = DB::table('quotation_items')->where('parent_id', $this->id)->where('deleted', 0)->get();

        return [
            'id' => $quotation->id,
            'quotation_no' => $prefix."-".$quotation->quotation_no,
            'delivery_no' => $quotation->delivery_no,
            'invoice_no' => $quotation->invoice_no,
            'name' => $quotation->name,
            'parent_id' => $quotation->parent_id,
            'parent_type' => $quotation->parent_type,
            'bill_no' => $quotation->bill_no,
            'bill_date' => $datetime->to_display_date($quotation->bill_date),
            'total_taxable' => $quotation->total_taxable,
            'total_tax' => $quotation->total_tax,
            'grand_total' => $quotation->grand_total,
            'client_master' => (new ClientMasterResource($quotation->clients))??'',
            'firm_name' =>  (new ClientMasterResource($quotation->clients))->firm_name??'',
            'status' => $quotation->status,
            'description' => $quotation->description,
            'quotation_date' => $datetime->to_display_date($quotation->date_entered),
            'date_entered' => $datetime->to_display_date_time($quotation->date_entered),
            'date_modified' => $datetime->to_display_date_time($quotation->date_modified),
            'quotation_items'=>$item_data,
        ];
    }
}
////'category_name' => (new CategoryResource($purchase->category))->name??'',