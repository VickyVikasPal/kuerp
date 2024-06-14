<?php
namespace App\Modules\Invoices;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\ClientMaster;
use App\Common\Base64ToImage;
use App\Modules\Invoices\Resources\InvoiceResource;
use App\Modules\Invoices\Requests\StoreRequest;
use App\Common\Datetime\TimeDate;
use Carbon\Carbon;
use DB;
use App\Models\InvoiceItem;
use App\Http\Controllers\CustomCode;
use App\Common\Utils;


class EditView{

    public function addData(StoreRequest $request){

        $datetime = new TimeDate();
        $generateKey = new Utils();
        $invoice = new Invoice();
        $currentdate = $datetime->get_gmt_db_datetime();
        $options = array('tableName'=>$invoice->table, 'dateField'=>$currentdate);
        $seqNO = $generateKey->autoGenerateKey($options);

        $formData = $request->get('formData');
        $itemData = $request->get('itemData');
        
        $invoice->name = $seqNO;
        $invoice->parent_type = 'clientmasters';
        $invoice->parent_id = $formData['client_id'];
        $invoice->total_taxable = $formData['taxable'];
        $invoice->total_tax = $formData['totalTax'];
        $invoice->grand_total = $formData['grandTotal'];        
        $invoice->invoice_no = $seqNO;
        $invoice->status = 'Invoice Done';
      
        if ($invoice->save()) {
            $invoice_id = $invoice->id;
            foreach($itemData as $key => $value)
            {
               
            $poduct_id =$value['id'];
            $product_data = Product::find($poduct_id);
          
            $productQty = $product_data->product_qty;
            $invoice_item = new InvoiceItem();
            
            $invoice_item->name = $value['name'];
            $invoice_item->parent_type = 'invoices';
            $invoice_item->parent_id = $invoice_id;
            $invoice_item->product_id = $value['id'];
            $invoice_item->hsn_code = $value['hsn_code'];
            $invoice_item->product_code = $product_data->product_code;
            $invoice_item->qty = $value['qty'];
            $invoice_item->unit_price = $value['unit_price'];
            $invoice_item->total_value = $value['total_value'];
            $invoice_item->discount = $value['discount'];
            $invoice_item->discount_amount = $value['discount_amount'];
            $invoice_item->taxable_value = $value['taxable_value'];
            $invoice_item->tax_type = $product_data->tax_type;
            $invoice_item->cgst = $value['cgst'];
            $invoice_item->sgst = $value['sgst'];
            $invoice_item->igst = $value['igst'];
            $invoice_item->total_amount = $value['total_amount'];
            $invoice_item->status = 'Invoice Done';
            $invoice_item->description = $product_data->description;

            $invoice_item->save();

            $product_data->product_qty = ($productQty-$value['qty']);
            $product_data->save();
            }
            return response()->json(['error_message'=>'', 'message' => 'Data saved correctly', 'invoice_id' => $invoice_id]);
        }else{
            return response()->json(['error_message' => 'Stock Not Available', 'invoice_id' => $invoice_id]);
        }

}

    public function removeItem($request)
    {
        if(!empty($request->get('del_id')))
        {
            $invoiceItem = InvoiceItem::find($request->get('del_id'));

            $product_id = $invoiceItem->product_id;
            $returnQty = $invoiceItem->qty;

            $product = Product::find($product_id);

            $product->product_qty = ($product->product_qty + $returnQty);

            $product->save();

            $invoiceItem->qty = 0;
            $invoiceItem->deleted = 1;
           // $remove = DB::table('invoice_items')->where('id', $request->get('del_id'))->update(array('deleted'=>1));
            if($invoiceItem->save())
            {
                return response()->json(['message'=>'success'], 200);
            }
        }else{
            return response()->json(['message'=>'fail'], 500);
        }
    }

    public function CheckInvoicePayment($request)
    {
        $invoice_id = $request->get('invoice_id');

        $invoice_data = Invoice::find($invoice_id);

        return response()->json($invoice_data);
    }
}