<?php
namespace App\Modules\DeliveryChallans;

use App\Models\Product;
use App\Models\DeliveryChallan;
use App\Models\DeliveryChallanItem;
use App\Http\Resources\Product\ProductResource;
use App\Modules\DeliveryChallans\Requests\UpdateRequest;
use App\Common\Base64ToImage;
use App\Models\ClientMaster;
use DB;
use Auth;

class DetailView{

    var $parent_id;
    var $parent_type;
    var $name;
    var $price;
    var $description;
    var $foodradio;
    var $foodtype;
    var $message;
    var $foodselect;
    var $status;

    public function updateDetails(UpdateRequest $request, DeliveryChallan $deliverychallan){

        $user = Auth::user();
       // $selectbox_value = $request->get('select');
        $delivery_id = $request->get('delivery_id');
       $delivery = DeliveryChallan::find($delivery_id);

       $delivery->total_taxable = $request->get('total_taxable');
       $delivery->total_tax = $request->get('total_tax');
       $delivery->grand_total = $request->get('grand_total');
       $delivery->status = 'Quotation Done';
        if ($delivery->save()) {
            DB::table('delivery_items')->where('parent_id', $delivery_id)->where('deleted', 0)->where('branch_id', $user->branch_id)->update(array('status'=>'DeliveryDone'));
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message'=>'success']);
        }
        
    }

    public function updateDelivery(UpdateRequest $request, DeliveryChallanItem $deliveryItem)
    {
        $delivery_id = $request->get('delivery_id');
        $poduct_id = $request->get('product_id');
        $product_data = Product::find($poduct_id);
        if(!empty($product_data->product_qty) && $product_data->product_qty > 0){
        $deliveryItem = new DeliveryChallanItem();

        $taxable_price = round(($product_data->taxable_price * $request->get('product_qty')), PHP_ROUND_HALF_UP);
        $taxable_price = round($taxable_price, 2);
        $total_value = $taxable_price;
        $discount_amt = 0;
        if($request->get('discount') > 0)
        {
            $discount_amt = round(($taxable_price * $request->get('discount'))/100, PHP_ROUND_HALF_UP);
            $discount_amt = round($discount_amt, 2);
            $taxable_price = round(($taxable_price - $discount_amt), PHP_ROUND_HALF_UP);
            $taxable_price = round($taxable_price, 2);
        }else{
            $taxable_price = $taxable_price;
        }
        $state = env('USER_STATE');
        $vendor = ClientMaster::find($request->get('client_id'));
        $sgst = 0;
        $cgst = 0;
        $igst = 0;
        if($state == $vendor->state)
        {
            $tax = round(($taxable_price * $product_data->tax_type)/100, PHP_ROUND_HALF_UP);
            $sgst = $tax / 2;
            $cgst = $tax / 2;
            $sgst = round($sgst, 2);
            $cgst = round($cgst, 2);
        }else{
            $igst = round(($taxable_price * $product_data->tax_type)/100, PHP_ROUND_HALF_UP);
            $igst = round($igst, 2);
        }

        $totalAmount = round(($taxable_price + $sgst + $cgst + $igst), PHP_ROUND_HALF_UP);
        $totalAmount = round($totalAmount, 2);
        
        $deliveryItem->name = $product_data->name;
        $deliveryItem->parent_type = 'deliverys';
        $deliveryItem->parent_id = $delivery_id;
        $deliveryItem->product_id = $product_data->id;
        $deliveryItem->hsn_code = $product_data->hsn_sac_code;
        $deliveryItem->product_code = $product_data->product_code;
        $deliveryItem->qty = $request->get('product_qty');
        $deliveryItem->unit_price = $product_data->taxable_price;
        $deliveryItem->total_value = $total_value;
        $deliveryItem->discount = $request->get('discount');
        $deliveryItem->discount_amount = $discount_amt;
        $deliveryItem->taxable_value = $taxable_price;
        $deliveryItem->tax_type = $product_data->tax_type;
        $deliveryItem->cgst = $cgst;
        $deliveryItem->sgst = $sgst;
        $deliveryItem->igst = $igst;
        $deliveryItem->total_amount = $totalAmount;
        $deliveryItem->status = 'Pending';
        $deliveryItem->description = $product_data->description;

        $deliveryItem->save();

        $product_data->product_qty = ($product_data->product_qty - $request->get('product_qty'));
        if($product_data->save()){
                return response()->json(['message'=>'success'], 200);
            
                }else{
                    return response()->json(['message'=>'fail'], 500);
                }

        }
    }
}