<?php
namespace App\Modules\Quotations;

use App\Models\Quotation;
use App\Models\Product;
use App\Models\ClientMaster;
use App\Common\Base64ToImage;
use App\Modules\Quotations\Resources\QuotationResource;
use App\Modules\Quotations\Requests\StoreRequest;
use App\Common\Datetime\TimeDate;
use Carbon\Carbon;
use DB;
use App\Models\QuotationItem;
use App\Http\Controllers\CustomCode;
use App\Common\Utils;
use App\Models\DeliveryChallan;
use Illuminate\Support\Facades\Auth;
use App\Models\DeliveryChallanItem;


class EditView{

    public function addData(StoreRequest $request){

        $dateTime = new TimeDate();
        if(!empty($request->get('quotation_id'))){
            $quotation = Quotation::find($request->get('quotation_id'));
        }else{   
        $quotation = new Quotation();
        }    
        $quotation->parent_type = 'clientmasters';
        $quotation->parent_id = $request->get('client_id');
        $quotation->status = 'Pending';
              
        if ($quotation->save()) {
            $quotation_id = $quotation->id;
            $poduct_id = $request->get('product_id');
            $product_data = Product::find($poduct_id);
            if(!empty($product_data->product_qty) && $product_data->product_qty > 0){
            $quotation_item = new QuotationItem();

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
            
            $quotation_item->name = $product_data->name;
            $quotation_item->parent_type = 'quotations';
            $quotation_item->parent_id = $quotation_id;
            $quotation_item->product_id = $product_data->id;
            $quotation_item->hsn_code = $product_data->hsn_sac_code;
            $quotation_item->product_code = $product_data->product_code;
            $quotation_item->qty = $request->get('product_qty');
            $quotation_item->unit_price = $product_data->taxable_price;
            $quotation_item->total_value = $total_value;
            $quotation_item->discount = $request->get('discount');
            $quotation_item->discount_amount = $discount_amt;
            $quotation_item->taxable_value = $taxable_price;
            $quotation_item->tax_type = $product_data->tax_type;
            $quotation_item->cgst = $cgst;
            $quotation_item->sgst = $sgst;
            $quotation_item->igst = $igst;
            $quotation_item->total_amount = $totalAmount;
            $quotation_item->status = 'Pending';
            $quotation_item->description = $product_data->description;

            $quotation_item->save();
            $quotation_item_id = $quotation_item->id;
            $quotation_item_data = QuotationItem::find($quotation_item_id);
            return response()->json(['error_message'=>'', 'message' => 'Data saved correctly', 'quotation_id' => $quotation_id]);
        }else{
            return response()->json(['error_message' => 'Stock Not Available', 'quotation_id' => $quotation_id]);
        }
           
          
        }else{
        return response()->json(['message' => __('An error occurred while saving data')], 500);
        }

    }

    public function saveQuotation($request)
    {
        $quotation = Quotation::find($request->get('quotation_id'));
        $generateKey = new Utils();
        $datetime = new TimeDate();
        if($request->get('action') == 'save')
        {
            $qtnObj = new Quotation();
            $currentdate = $datetime->get_gmt_db_datetime();
           
           
            $options = array('tableName'=>$qtnObj->table, 'dateField'=>$currentdate);
            $seqNO = $generateKey->autoGenerateKey($options);
                      
            $quotation->total_taxable = $request->get('total_taxable');
            $quotation->total_tax = $request->get('total_tax');
            $quotation->grand_total = $request->get('grand_total');
            $quotation->status = 'Quotation Done';
            $quotation->quotation_no = $seqNO;
            if($quotation->save())
            {
                DB::table('quotation_items')->where('deleted', 0)->where('parent_id', $request->get('quotation_id'))->update(array('status'=>'Quotation Done'));
                return response()->json(['message' => 'Data Update Successfully'], 200);
            }
        }

        if($request->get('action') == 'cancel')
        {
           
            $quotation->status = 'Cancel';
            $quotation->deleted = 1;
            if($quotation->save())
            {
                DB::table('quotation_items')->where('deleted', 0)->where('parent_id', $request->get('quotation_id'))->update(array('deleted'=> 1, 'status'=>'Cancel'));
                return response()->json(['message' => 'Data Update Successfully'], 200);
            }
        }

    }

    public function removeItem($request)
    {
        if(!empty($request->get('del_id')))
        {
            $remove = DB::table('quotation_items')->where('id', $request->get('del_id'))->update(array('deleted'=>1));
            if($remove)
            {
                return response()->json(['message'=>'success'], 200);
            }
        }else{
            return response()->json(['message'=>'fail'], 500);
        }
    }

    
    public function updateQuotation($request)
    {
        $quotation = Quotation::find($request->get('quotation_id'));
        
        $datetime = new TimeDate();
        if($request->get('action') == 'save')
        {
            $qtnObj = new Quotation();
            $currentdate = $datetime->get_gmt_db_datetime();
                                 
            $quotation->total_taxable = $request->get('total_taxable');
            $quotation->total_tax = $request->get('total_tax');
            $quotation->grand_total = $request->get('grand_total');
            $quotation->status = 'Quotation Done';
          
            if($quotation->save())
            {
                DB::table('purchase_items')->where('deleted', 0)->where('parent_id', $request->get('purchase_id'))->update(array('status'=>'Quotation Done'));
                return response()->json(['message' => 'Data Update Successfully'], 200);
            }
        }

        if($request->get('action') == 'cancel')
        {
           
            $quotation->status = 'Cancel';
            $quotation->deleted = 1;
            if($quotation->save())
            {
                DB::table('purchase_items')->where('deleted', 0)->where('parent_id', $request->get('purchase_id'))->update(array('deleted'=> 1, 'status'=>'Cancel'));
                return response()->json(['message' => 'Data Update Successfully'], 200);
            }
        }

    }

    public function createDelivery($request)
    {
        $datetime = new TimeDate();
        $generateKey = new Utils();
        $user = Auth::user();
        
        $quotation_id = '';
        $quotation_id = $request->get('qtn_id');
        if($quotation_id !=""){
            $qtn_obj = Quotation::find($quotation_id);
            $delivery_obj = new DeliveryChallan();

            $currentdate = $datetime->get_gmt_db_datetime();
           
            $options = array('tableName'=>$delivery_obj->table, 'dateField'=>$currentdate);
            $seqNO = $generateKey->autoGenerateKey($options);

            $delivery_obj->parent_type = $qtn_obj->parent_type;
            $delivery_obj->parent_id = $qtn_obj->parent_id;
            $delivery_obj->quotation_id = $qtn_obj->id;
            //$delivery_obj->quotation_no = $qtn_obj->quotation_no;
            $delivery_obj->delivery_no = $seqNO;
            $delivery_obj->total_taxable = $qtn_obj->total_taxable;
            $delivery_obj->total_tax = $qtn_obj->total_tax;
            $delivery_obj->grand_total = $qtn_obj->grand_total;
            $delivery_obj->status = 'Delivery Done';

            $delivery_obj->save();
            
            $delivery_id = $delivery_obj->id;

            $qtn_obj->delivery_no = $seqNO;
            $qtn_obj->status = 'Delivery Done';

            $qtn_obj->save();

            $qtn_item = DB::table('quotation_items')->where('parent_id', $quotation_id)->where('deleted', 0)->where('branch_id', $user->branch_id)->get();

            if(count($qtn_item) > 0){
                foreach($qtn_item as $key => $value){
                    $delivery_item = new DeliveryChallanItem();

                    $delivery_item->name = $value->name;
                    $delivery_item->parent_type = 'deliverys';
                    $delivery_item->parent_id = $delivery_id;
                    $delivery_item->product_id = $value->product_id;
                    $delivery_item->hsn_code = $value->hsn_code;
                    $delivery_item->product_code = $value->product_code;
                    $delivery_item->qty = $value->qty;
                    $delivery_item->unit_price = $value->unit_price;
                    $delivery_item->total_value = $value->total_value;
                    $delivery_item->discount = $value->discount;
                    $delivery_item->discount_amount = $value->discount_amount;
                    $delivery_item->taxable_value = $value->taxable_value;
                    $delivery_item->tax_type = $value->tax_type;
                    $delivery_item->cgst = $value->cgst;
                    $delivery_item->sgst = $value->sgst;
                    $delivery_item->igst = $value->igst;
                    $delivery_item->total_amount = $value->total_amount;
                    $delivery_item->status = 'Delivery Done';
                    $delivery_item->description = $value->description;

                    $delivery_item->save();

                    $product = Product::find($value->product_id);

                    $new_qty = $product->product_qty - $value->qty;

                    $product->product_qty = $new_qty;

                    $product->save();
                }
            }

            return response()->json(['message' => 'Data Update Successfully', 'delivery_id' => $delivery_id], 200);
        }
        else{
            return response()->json(['message' => 'Quotation Not Found', 'quotation_id' => $quotation_id], 200);
        }
    }
}