<?php

namespace App\Modules\DeliveryChallans\Resources;

use App\Models\DeliveryChallan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\ClientMasters\Resources\ClientMasterResource;
use JsonException;
use App\Common\Datetime\TimeDate;
use App\Common\Utils;
use Illuminate\Support\Facades\Auth;
use DB;

class DeliveryChallanResource extends JsonResource
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
        $delivery = $this;
        $datetime = new TimeDate();
        $item_data = "";
        $autoGenerate = new Utils();
        $user = Auth::user();

        $options = array('tableName'=> $delivery->table, 'branch_id'=>$user->branch_id);

        $prefix = $autoGenerate->autoGeneratePrefix($options);

        $item_data = DB::table('delivery_items')->where('parent_id', $this->id)->where('deleted', 0)->get();

        return [
            'id' => $delivery->id,
            'delivery_no' => $prefix."-".$delivery->delivery_no,
            'invoice_no' => $delivery->invoice_no,
            'name' => $delivery->name,
            'parent_id' => $delivery->parent_id,
            'parent_type' => $delivery->parent_type,
            'total_taxable' => $delivery->total_taxable,
            'total_tax' => $delivery->total_tax,
            'grand_total' => $delivery->grand_total,
            'client_master' => (new ClientMasterResource($delivery->clients))??'',
            'firm_name' => (new ClientMasterResource($delivery->clients))->name??'',
            'status' => $delivery->status,
            'description' => $delivery->description,
            'delivery_date' => $datetime->to_display_date($delivery->date_entered),
            'date_entered' => $datetime->to_display_date_time($delivery->date_entered),
            'date_modified' => $datetime->to_display_date_time($delivery->date_modified),
            'delivery_items'=>$item_data,
        ];
    }
}
