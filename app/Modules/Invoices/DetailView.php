<?php
namespace App\Modules\Invoices;

use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Http\Resources\Product\ProductResource;
use App\Modules\Invoices\Requests\UpdateRequest;
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

    public function updateDetails(UpdateRequest $request, Invoice $invoice){

        $user = Auth::user();
       // $selectbox_value = $request->get('select');
        $invoice_id = $request->get('invoice_id');
       $invoice = Invoice::find($invoice_id);

       $invoice->total_taxable = $request->get('total_taxable');
       $invoice->total_tax = $request->get('total_tax');
       $invoice->grand_total = $request->get('grand_total');
       $invoice->status = 'Invoice Done';
        if ($invoice->save()) {
            DB::table('invoice_items')->where('parent_id', $invoice_id)->where('deleted', 0)->where('branch_id', $user->branch_id)->update(array('status'=>'DeliveryDone'));
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['message'=>'success']);
        }
        
    }

    public function updateInvoice(UpdateRequest $request, InvoiceItem $invoiceItem)
    {
        $invoice_id = $request->get('invoice_id');
        $poduct_id = $request->get('product_id');
        $product_data = Product::find($poduct_id);
        if(!empty($product_data->product_qty) && $product_data->product_qty > 0){
        $invoiceItem = new InvoiceItem();

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
        
        $invoiceItem->name = $product_data->name;
        $invoiceItem->parent_type = 'invoices';
        $invoiceItem->parent_id = $invoice_id;
        $invoiceItem->product_id = $product_data->id;
        $invoiceItem->hsn_code = $product_data->hsn_sac_code;
        $invoiceItem->product_code = $product_data->product_code;
        $invoiceItem->qty = $request->get('product_qty');
        $invoiceItem->unit_price = $product_data->taxable_price;
        $invoiceItem->total_value = $total_value;
        $invoiceItem->discount = $request->get('discount');
        $invoiceItem->discount_amount = $discount_amt;
        $invoiceItem->taxable_value = $taxable_price;
        $invoiceItem->tax_type = $product_data->tax_type;
        $invoiceItem->cgst = $cgst;
        $invoiceItem->sgst = $sgst;
        $invoiceItem->igst = $igst;
        $invoiceItem->total_amount = $totalAmount;
        $invoiceItem->status = 'Pending';
        $invoiceItem->description = $product_data->description;

        $invoiceItem->save();

        $product_data->product_qty = ($product_data->product_qty - $request->get('product_qty'));
        if($product_data->save()){
                return response()->json(['message'=>'success'], 200);
            
                }else{
                    return response()->json(['message'=>'fail'], 500);
                }

        }
    }
}