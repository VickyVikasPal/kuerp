<?php
namespace App\Modules\Purchases;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\VendorMaster;
use App\Common\Base64ToImage;
use App\Modules\Purchases\Resources\PurchaseResource;
use App\Modules\Purchases\Requests\StoreRequest;
use App\Common\Datetime\TimeDate;
use Carbon\Carbon;
use DB;
use App\Models\PurchaseItem;

class EditView{

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

    public function addData(StoreRequest $request){

        $dateTime = new TimeDate();
      if(!empty($request->get('purchase_id')))
      {
        $purchase = Purchase::find($request->get('purchase_id'));
      }else{
        $purchase = new Purchase();            
      }
        $purchase->parent_type = 'vendormasters';
        $purchase->parent_id = $request->get('vendor_id');
        $purchase->bill_no = $request->get('bill_no');
        $purchase->bill_date = $request->get('bill_date');
        $purchase->status = 'Pending';
              
        if ($purchase->save()) {
            $purchase_id = $purchase->id;
            $poduct_id = $request->get('product_id');
            $product_data = Product::find($poduct_id);
            $purchase_item = new PurchaseItem();

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
            $vendor = VendorMaster::find($request->get('vendor_id'));
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
            
            $purchase_item->name = $product_data->name;
            $purchase_item->parent_type = 'purchases';
            $purchase_item->parent_id = $purchase_id;
            $purchase_item->product_id = $product_data->id;
            $purchase_item->hsn_code = $product_data->hsn_sac_code;
            $purchase_item->product_code = $product_data->product_code;
            $purchase_item->qty = $request->get('product_qty');
            $purchase_item->unit_price = $product_data->taxable_price;
            $purchase_item->total_value = $total_value;
            $purchase_item->discount = $request->get('discount');
            $purchase_item->discount_amount = $discount_amt;
            $purchase_item->taxable_value = $taxable_price;
            $purchase_item->tax_type = $product_data->tax_type;
            $purchase_item->cgst = $cgst;
            $purchase_item->sgst = $sgst;
            $purchase_item->igst = $igst;
            $purchase_item->total_amount = $totalAmount;
            $purchase_item->status = 'Pending';
            $purchase_item->description = $product_data->description;

            $purchase_item->save();
            $purchase_item_id = $purchase_item->id;
            $purchase_item_data = PurchaseItem::find($purchase_item_id);
           
           
          return response()->json(['message' => 'Data saved correctly', 'purchase_id' => $purchase_id, 'purchase_item'=>$purchase_item]);
        }else{
        return response()->json(['message' => __('An error occurred while saving data')], 500);
        }

    }

    public function savePurchase($request)
    {
        $purchase = Purchase::find($request->get('purchase_id'));
       
        if($request->get('action') == 'save')
        {
           
            $purchase->total_taxable = $request->get('total_taxable');
            $purchase->total_tax = $request->get('total_tax');
            $purchase->grand_total = $request->get('grand_total');
            $purchase->status = 'Processed';
            if($purchase->save())
            {
                DB::table('purchase_items')->where('deleted', 0)->where('parent_id', $request->get('purchase_id'))->update(array('status'=>'Processed'));
                return response()->json(['message' => 'Data Update Successfully'], 200);
            }
        }

        if($request->get('action') == 'cancel')
        {
           
            $purchase->status = 'Cancel';
            $purchase->deleted = 1;
            if($purchase->save())
            {
                DB::table('purchase_items')->where('deleted', 0)->where('parent_id', $request->get('purchase_id'))->update(array('deleted'=> 1, 'status'=>'Cancel'));
                return response()->json(['message' => 'Data Update Successfully'], 200);
            }
        }

    }

    public function removeItem($request)
    {
        if(!empty($request->get('del_id')))
        {
            $remove = DB::table('purchase_items')->where('id', $request->get('del_id'))->update(array('deleted'=>1));
            if($remove)
            {
                return response()->json(['message'=>'success'], 200);
            }
        }else{
            return response()->json(['message'=>'fail'], 500);
        }
    }

    public function updateInventory($request)
    {
        $items = DB::table('purchase_items')->where('parent_id', $request->get('purchase_id'))->where('deleted', 0)->get();
        $msg = 0;
        foreach($items as $key => $value)
        {
            $product = Product::find($value->product_id);

            $product->product_qty = $product->product_qty + $value->qty;

            if($product->save())
            {
                $msg = 0;
            }else{
                $msg = 1;
            }
        }

        $remove = DB::table('purchase_items')->where('parent_id', $request->get('purchase_id'))->where('deleted', 0)->update(array('status'=>'Done'));
        $purchase = Purchase::find($request->get('purchase_id'));
        $purchase->status = 'Done';
        $purchase->save();

        if($msg == 0)
        {
            return response()->json(['message'=>"Update"], 200);
        }else{
            return response()->json(['message'=>"Unable to update"], 500);
        }
    }

}