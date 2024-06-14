<?php
namespace App\Modules\DeliveryChallans;

use App\Models\DeliveryChallan;
use App\Models\DeliveryChallanItem;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Quotation;
use App\Models\Product;
use App\Models\ClientMaster;
use App\Common\Base64ToImage;
use App\Modules\DeliveryChallans\Resources\DeliveryChallanResource;
use App\Modules\DeliveryChallans\Requests\StoreRequest;
use App\Common\Datetime\TimeDate;
use Carbon\Carbon;
use DB;
use App\Http\Controllers\CustomCode;
use App\Common\Utils;
use Illuminate\Support\Facades\Auth;


class EditView{

    public function addData(StoreRequest $request){

        $datetime = new TimeDate();
        $generateKey = new Utils();
        $delivery = new DeliveryChallan();
        $currentdate = $datetime->get_gmt_db_datetime();
        $options = array('tableName'=>$delivery->table, 'dateField'=>$currentdate);
        $seqNO = $generateKey->autoGenerateKey($options);

        $formData = $request->get('formData');
        $itemData = $request->get('itemData');
                 
        $delivery->parent_type = 'clientmasters';
        $delivery->parent_id = $formData['client_id'];
        $delivery->total_taxable = $formData['taxable'];
        $delivery->total_tax = $formData['totalTax'];
        $delivery->grand_total = $formData['grandTotal'];        
        $delivery->delivery_no = $seqNO;
        $delivery->status = 'Delivery Done';
      
        if ($delivery->save()) {
            $delivery_id = $delivery->id;
            foreach($itemData as $key => $value)
            {
               
            $poduct_id =$value['id'];
            $product_data = Product::find($poduct_id);
          
            $productQty = $product_data->product_qty;
            $delivery_item = new DeliveryChallanItem();
            
            $delivery_item->name = $value['name'];
            $delivery_item->parent_type = 'deliverys';
            $delivery_item->parent_id = $delivery_id;
            $delivery_item->product_id = $value['id'];
            $delivery_item->hsn_code = $value['hsn_code'];
            $delivery_item->product_code = $product_data->product_code;
            $delivery_item->qty = $value['qty'];
            $delivery_item->unit_price = $value['unit_price'];
            $delivery_item->total_value = $value['total_value'];
            $delivery_item->discount = $value['discount'];
            $delivery_item->discount_amount = $value['discount_amount'];
            $delivery_item->taxable_value = $value['taxable_value'];
            $delivery_item->tax_type = $product_data->tax_type;
            $delivery_item->cgst = $value['cgst'];
            $delivery_item->sgst = $value['sgst'];
            $delivery_item->igst = $value['igst'];
            $delivery_item->total_amount = $value['total_amount'];
            $delivery_item->status = 'Delivery Done';
            $delivery_item->description = $product_data->description;

            $delivery_item->save();

            $product_data->product_qty = ($productQty-$value['qty']);
            $product_data->save();
            }
            return response()->json(['error_message'=>'', 'message' => 'Data saved correctly', 'delivery_id' => $delivery_id]);
        }else{
            return response()->json(['error_message' => 'Stock Not Available', 'delivery_id' => $delivery_id]);
        }

}

    public function removeItem($request)
    {
        if(!empty($request->get('del_id')))
        {
            $deliveryItem = DeliveryChallanItem::find($request->get('del_id'));

            $product_id = $deliveryItem->product_id;
            $returnQty = $deliveryItem->qty;

            $product = Product::find($product_id);

            $product->product_qty = ($product->product_qty + $returnQty);

            $product->save();

            $deliveryItem->qty = 0;
            $deliveryItem->deleted = 1;
           // $remove = DB::table('delivery_items')->where('id', $request->get('del_id'))->update(array('deleted'=>1));
            if($deliveryItem->save())
            {
                return response()->json(['message'=>'success'], 200);
            }
        }else{
            return response()->json(['message'=>'fail'], 500);
        }
    }

    public function copeyToInvoice($request)
    {
        $datetime = new TimeDate();
        $generateKey = new Utils();
        $user = Auth::user();

        $delivery_id = '';
        $delivery_id = $request->get('delivery_id');
        if($delivery_id !=""){
        $deliveryData = DeliveryChallan::find($delivery_id);

        $invoice_obj = new Invoice();

            $currentdate = $datetime->get_gmt_db_datetime();
           
            $options = array('tableName'=>$invoice_obj->table, 'dateField'=>$currentdate);
            $seqNO = $generateKey->autoGenerateKey($options);

            $invoice_obj->name = $seqNO;
            $invoice_obj->parent_type = $deliveryData->parent_type;
            $invoice_obj->parent_id = $deliveryData->parent_id;
            $invoice_obj->quotation_id = $deliveryData->quotation_id;
            $invoice_obj->delivery_id = $deliveryData->id;
            $invoice_obj->invoice_no = $seqNO;
            $invoice_obj->total_taxable = $deliveryData->total_taxable;
            $invoice_obj->total_tax = $deliveryData->total_tax;
            $invoice_obj->grand_total = $deliveryData->grand_total;
            $invoice_obj->status = 'Invoice Done';

            $invoice_obj->save();
            
            $invoice_id = $invoice_obj->id;

            $deliveryData->invoice_no = $seqNO;
            $deliveryData->status = 'Invoice Done';

            $deliveryData->save();

            $qtn = Quotation::find($deliveryData->quotation_id);
            $qtn->invoice_no = $seqNO;
            $qtn->save();

            $d_item = DB::table('delivery_items')->where('parent_id', $delivery_id)->where('deleted', 0)->where('branch_id', $user->branch_id)->get();

            if(count($d_item) > 0){
                foreach($d_item as $key => $value){
                    $invoice_item = new InvoiceItem();

                    $invoice_item->name = $value->name;
                    $invoice_item->parent_type = 'invoices';
                    $invoice_item->parent_id = $invoice_id;
                    $invoice_item->product_id = $value->product_id;
                    $invoice_item->hsn_code = $value->hsn_code;
                    $invoice_item->product_code = $value->product_code;
                    $invoice_item->qty = $value->qty;
                    $invoice_item->unit_price = $value->unit_price;
                    $invoice_item->total_value = $value->total_value;
                    $invoice_item->discount = $value->discount;
                    $invoice_item->discount_amount = $value->discount_amount;
                    $invoice_item->taxable_value = $value->taxable_value;
                    $invoice_item->tax_type = $value->tax_type;
                    $invoice_item->cgst = $value->cgst;
                    $invoice_item->sgst = $value->sgst;
                    $invoice_item->igst = $value->igst;
                    $invoice_item->total_amount = $value->total_amount;
                    $invoice_item->status = 'Invoice Done';
                    $invoice_item->description = $value->description;

                    $invoice_item->save();
                }
            }

            return response()->json(['message' => 'Data Update Successfully', 'Invoice_id' => $invoice_id], 200);
        }
        else{
            return response()->json(['message' => 'Quotation Not Found', 'invoice_id' => $invoice_id], 200);
        }
    }

}