<?php
namespace App\Modules\Payments;

use App\Models\Payment;
use App\Models\Invoice;
use App\Common\Base64ToImage;
use App\Modules\Payments\Resources\PaymentResource;
use App\Modules\Payments\Requests\StoreRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use File;
use Cache;
Use Auth;
use App\Http\Controllers\CustomCode;
use App\Common\Utils;
use App\Common\Datetime\TimeDate;

class EditView{

    public function addData(StoreRequest $request){
      $user = Auth::user();
      
        $payments = new Payment();
       
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        
        $payments->name = $request->name;
        $payments->status = $request->status;
        $payments->branch_id = $user->branch_id;
        //print_r($payments);
        if($payments->save()){
            return response()->json(['message' => 'Data saved correctly', 'payments' => new PaymentResource($payments)]);
        }else{
            return response()->json(['message' => __('An error occurred while saving data')], 500);
 
        }
    }
    public function updateInvoicePayment($request)
    {
        $datetime = new TimeDate();
        $generateKey = new Utils();
        $paymentObj = new Payment();

        $invoice_id = $request->get('invoice_id');
        $invoiceObj = Invoice::find($invoice_id);

        $currentdate = $datetime->get_gmt_db_datetime();
        $options = array('tableName'=>$paymentObj->table, 'dateField'=>$currentdate);
        $seqNO = $generateKey->autoGenerateKey($options);

        $paymentObj->name = $seqNO;
        $paymentObj->payment_no = $seqNO;
        $paymentObj->payment_mode = $request->get('payments')['payment_mode'];
        $paymentObj->transaction_no = $request->get('payments')['transaction_no'];
        $paymentObj->transaction_remark = $request->get('payments')['transaction_remark'];
        $paymentObj->parent_type = 'invoices';
        $paymentObj->parent_id = $invoice_id;
        $paymentObj->total_taxable = $invoiceObj->total_taxable;
        $paymentObj->total_tax = $invoiceObj->total_tax;
        $paymentObj->grand_total = $invoiceObj->grand_total;
        $paymentObj->invoice_no = $invoiceObj->invoice_no;
        $paymentObj->status = 'Received';
        $paymentObj->save();

        $payment_id = $paymentObj->id;

        $invoiceObj->payment_status = 'Received';
        $invoiceObj->payment_id = $payment_id;
        $invoiceObj->save();
        
        if(!empty($payment_id)){
            return response()->json(['message'=>'Payment Updated Successfully', 'payment_id'=>$payment_id]);
        }else{
            return response()->json(['message'=>'Payment Not Updated', 'payment_id'=>'']);
        }
    }
}