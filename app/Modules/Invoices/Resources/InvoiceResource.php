<?php

namespace App\Modules\Invoices\Resources;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\ClientMasters\Resources\ClientMasterResource;
use App\Modules\DeliveryChallans\Resources\DeliveryChallanResource;
use JsonException;
use App\Common\Datetime\TimeDate;
use App\Common\Utils;
use DB;
use Illuminate\Support\Facades\Auth;

class InvoiceResource extends JsonResource
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
        $invoice = $this;
        $datetime = new TimeDate();
        $item_data = "";
        $autoGenerate = new Utils();
        $user = Auth::user();

        $options = array('tableName'=> $invoice->table, 'branch_id'=>$user->branch_id);

        $prefix = $autoGenerate->autoGeneratePrefix($options);

        $item_data = DB::table('invoice_items')->where('parent_id', $this->id)->where('deleted', 0)->get();

        return [
            'id' => $invoice->id,
            //'delivery_no' => (new DeliveryChallanResource($invoice->deliverys))->delivery_no??'',
            'invoice_no' => $prefix."-".$invoice->invoice_no,
            'name' => $invoice->name,
            'parent_id' => $invoice->parent_id,
            'parent_type' => $invoice->parent_type,
            'total_taxable' => $invoice->total_taxable,
            'total_tax' => $invoice->total_tax,
            'grand_total' => $invoice->grand_total,
            'client_master' => (new ClientMasterResource($invoice->clients))??'',
            'firm_name' => (new ClientMasterResource($invoice->clients))->name??'',
            'status' => $invoice->status,
            'payment_status' => $invoice->payment_status,
            'payment_date' => $datetime->to_display_date($invoice->date_entered),
            'description' => $invoice->description,
            'invoice_date' => $datetime->to_display_date($invoice->date_entered),
            'date_entered' => $datetime->to_display_date_time($invoice->date_entered),
            'date_modified' => $datetime->to_display_date_time($invoice->date_modified),
            'invoice_items'=>$item_data,
        ];
    }
}
