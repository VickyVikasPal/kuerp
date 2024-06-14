<?php
/*********************************************************************************
 * This program is developed by Softdev Infotech Pvt. Ltd.
 * Copyright Softdev Infotech Pvt. Ltd. 2023
 *********************************************************************************/
namespace App\Modules\Invoices\Pdf;

use Healpdf;
use Illuminate\Http\Request;
use Auth;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\InvoiceItem;
use App\Models\ClientMaster;
use Illuminate\Support\Facades\Session;
use App\Common\Utils;
use App\Common\Datetime\TimeDate;
use DB;
use Config;


class HealInvoice extends Healpdf
{
    
    public function Display(Request $request, $id)
    {
        $generateKey = new Utils();
        $datetime = new TimeDate();

    $this->pdfType = 'Tax Invoice';
    Parent::Header();

        // set document information
$this->SetCreator(PDF_CREATOR);
$this->SetAuthor('SoftDev');
$this->SetTitle('Tax Invoice');


// Add a page
        // This method has several options, check the source code documentation for more information.
        $this->SetMargins(5, 48, 5, true); // set the margins 
        
        $this->AddPage();
        $html = '';
        $this->SetLineStyle( array('width'=>0.40, 'dash' => 0, 'color'=> array(0,0,0)));
        $this->Rect(5, 45, 200, 50, 'DF', '', array(255, 255, 255));
      
        $deliveryObj = new Invoice();
        $invoice_data = Invoice::find($id);
        $prefix = "";
        $options = array('tableName'=>$deliveryObj->table, 'branch_id'=>$invoice_data->branch_id);
        $prefix = $generateKey->autoGeneratePrefix($options);

        $client_data = ClientMaster::find($invoice_data->parent_id);
        /*================ customer Data Area =====================*/
        $html .= ' <table cellpadding="0" cellspacing="0" width="100%" >
        <tr>
            <td width="55%">
                <table cellpadding="1" cellspacing="0" width="100%">
                    <tr>
                        <td width="60px"><b>Bill To</b></td>
                        <td width="10px">:</td>
                        <td width="200px"><b>'.$client_data->client_id.'&nbsp;|&nbsp;'.$client_data->name.'</b></td>
                    </tr>
                    <tr>
                        <td width="60px"><b></b></td>
                        <td width="10px"></td>
                        <td>'.$client_data->address.'</td>
                    </tr>
                    <tr>
                        <td width="60px"><b></b></td>
                        <td width="10px"></td>
                        <td>'.$client_data->area.'</td>
                    </tr>
                    <tr>
                        <td width="60px"><b></b></td>
                        <td width="10px"></td>
                        <td>'.$client_data->state.' - '.$client_data->pin_no.'</td>
                    </tr>
                    <tr>
                        <td width="60px"><b>Ship To</b></td>
                        <td width="10px">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td width="60px"><b></b></td>
                        <td width="10px"></td>
                        <td>'.$client_data->address.'</td>
                    </tr>
                    <tr>
                        <td width="60px"><b></b></td>
                        <td width="10px"></td>
                        <td>'.$client_data->area.'</td>
                    </tr>
                    <tr>
                        <td width="60px"><b></b></td>
                        <td width="10px"></td>
                        <td>'.$client_data->state.' - '.$client_data->pin_no.'</td>
                    </tr>
                </table>
            </td>
            <td width="45%">
                <table cellpadding="3" cellspacing="0" width="100%">
                    <tr>
                        <td width="100px"><b>Document No.</b></td>
                        <td width="20px">:</td>
                        <td width="200px">'.$prefix.'-'.$invoice_data->invoice_no.'</td>
                    </tr>
                    <tr>
                        <td width="100px"><b>Date</b></td>
                        <td width="20px">:</td>
                        <td>'.$datetime->to_display_date($invoice_data->date_entered).'</td>
                    </tr>
                    <tr>
                        <td width="100px"><b>Customer CST</b></td>
                        <td width="20px">:</td>
                        <td>'.$client_data->gst_number.'</td>
                    </tr>
                    <tr>
                        <td width="100px"><b>Contact Number</b></td>
                        <td width="20px">:</td>
                        <td>'.$client_data->contact_no.'</td>
                    </tr>
                    <tr>
                        <td width="100px"><b>Transport Mode</b></td>
                        <td width="20px">:</td>
                        <td>Self</td>
                    </tr>
                   
                </table>
            </td>
        </tr>

    </table>';
// Print text using writeHTMLCell()
//die;

 
$this->writeHTML($html, true, false, true, false, '');



$items = InvoiceItem::where('parent_id', $id)->where('deleted', 0)->get();
// ---------------------------------------------------------

/*$this->SetLineStyle( array('width'=>0.40, 'dash' => 0, 'color'=> array(0,0,0)));
        $this->Rect(5, 95, 200, 195, '', '');*/
/*================== body section =================*/
$html = '';
$html .='<table cellpadding="2" cellspacing="0" border="1">
        
            <tr>
                <td width="37px"><b>Sl No.</b></td>
                <td width="80px"> <b>Product Code</b></td>
                <td width="120px"><b>Product Description</b></td>
                <td width="50px" align="center"><b>Rate</b></td>
                <td width="30px" align="center"><b>Qty</b></td>
                <td width="40px" align="center"><b>Discnt</b></td>
                <td width="40px" align="center"><b>Taxes</b></td>
                <td width="40px" align="center"><b>CGST</b></td>
                <td width="40px" align="center"><b>SGST</b></td>
                <td width="40px" align="center"><b>IGST</b></td>
                <td width="50px" align="center"><b>Total</b></td>
            </tr> ';
        $i = 1;
        $total_qty = 0;
        $total_taxbable = 0;
        $total_tax = 0;
        $total = 0;
                foreach($items as $key=>$value){
                        $html .='<tr>
                                <td>'.$i.'</td>
                                <td>'.$value->product_code.'</td>
                                <td>'.$value->name.'</td>
                                <td align="center">'.$value->unit_price.'</td>
                                <td align="center">'.$value->qty.'</td>
                                <td align="center">'.$value->discount_amount.'</td>
                                <td align="center">'.$value->taxable_value.'</td>
                                <td align="center">'.$value->cgst.'</td>
                                <td align="center">'.$value->sgst.'</td>
                                <td align="center">'.$value->igst.'</td>
                                <td align="center">'.$value->total_amount.'</td>
                        </tr>';
                        $i++;
                        $total_qty +=$value->qty;
                        $total_taxbable += $value->taxable_value;
                        $total_tax += ($value->cgst + $value->sgst + $value->igst);
                        $total += $value->total_amount;
                }
                
                
        $html .='</table>';

$this->writeHTML($html, true, false, true, false, '');

$html ='';

$html .='<table cellpadding="0" cellspacing="0" width="100%" style="border-bottom:1px solid #000;">
<tr>
    <td width="60%">
        <table cellpadding="2" cellspacing="0" width="100%" >
            <tr>
                <td width="140px"><b>Total No. Of Items</b></td>
                <td width="20px">:</td>
                <td>'.($i-1).'</td>
                
            </tr>
            <tr>
                <td width="140px"><b>Total No. Of Qty</b></td>
                <td width="20px">:</td>
                <td>'.$total_qty.'</td>
            </tr>
           
            <tr>
                <td width="140px"><b>Juridiction</b></td>
                <td width="20px">:</td>
                <td colspan="2">'.env('USER_STATE').'</td>

            </tr>
            <tr>
                <td width="140px"><b>Amount In Words</b></td>
                <td width="20px">:</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="4">'.self::numberToWord($total).'</td>
            </tr>
        </table>
    </td>
    <td width="40%">
        <table cellpadding="2" cellspacing="0" width="100%" >
            <tr>
                <td><b>Sub Total</b></td>
                <td></td>
                <td align="right">'.$total_taxbable.'</td>
            </tr>
            <tr>
                <td><b>GST @ 18 %</b></td>
                <td align="center"></td>
                <td align="right">'.$total_tax.'</td>
            </tr>
            <tr>
                <td><!--<b>Rounding</b>!--></td>
                <td></td>
                <td align="right"><!-- 0.00 !--></td>
            </tr>
            <tr>
                <td><!--<b>Freight</b>!--></td>
                <td></td>
                <td align="right"><!--0.00!--></td>
            </tr>
            <tr>
                <td><b>Total</b></td>
                <td></td>
                <td align="right"><b>'.$total.'</b></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="2" height="5px"></td>
</tr>
</table>';
///payment details
$html .='<table cellpadding="2" cellspacing="0" border="1" style="background-color: lightgrey;">
        
<tr>
    <td width="37px"><b>Sl No.</b></td>
    <td width="130px"> <b>Payment Date</b></td>
    <td width="130px"><b>Payment Mode</b></td>
    <td width="150px"><b>Transaction Number</b></td>
    <td width="120px"><b>Transaction Amount</b></td>
</tr>';
$payment = Payment::where('parent_id', $id)->where('deleted', 0)->get();
$count = 1;
foreach ($payment as $key => $value) {
    $html .='
            <tr>
            <td width="37px">'.$count.'</td>
            <td width="130px">'.$datetime->to_display_date($value->date_entered).'</td>
            <td width="130px">'.$value->payment_mode.'</td>
            <td width="150px">'.$value->transaction_no.'</td>
            <td width="120px">'.$value->grand_total.'</td>
        </tr>
            ';
}
$html .='</table>';

$html .='<h4> TERMS & CONDITIONS :</h4> ';

$html .='<table cellpadding="2" cellspacing="2" width="100%">
            <tr>
                <td>
                    1. Invoices or invoice creation are mandatory by the Government of India under GST laws. While making these invoices you have to take a lot of things under consideration.
                </td>
            </tr>
            <tr>
                <td>
                    2. One of these key elements is- The invoice payment terms and conditions.
                </td>
            </tr>
            <tr>
                <td>
                    3. One of these key elements is- The invoice payment terms and conditions.
                </td>
            </tr>
            <tr>
                <td>
                    4. One of these key elements is- The invoice payment terms and conditions.
                </td>
            </tr>
            <tr>
                <td height="30px"> </td>
            </tr>
            
        </table>
        <table cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="50%" valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td height="28px"></td>
                        </tr>
                        <tr>
                            <td>Customer Signature</td>
                        </tr>
                    </table>
                </td>
                <td width="50%" valign="top">
                    <table cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td align="right">For : '.env('APP_NAME').' &nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="right">Authorised Signature &nbsp;&nbsp;&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            
        </table>
    ';
$this->writeHTML($html, true, false, false, false, '');



// Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $this->Output($invoice_data->invoice_no.'.pdf', 'I');

//============================================================+
        // END OF FILE
        //============================================================+
    }

    function numberToWord($number){
        $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
          if(!empty($points)){
                return $result . "Rupees  " . $points . " Paise Only";
          }else{
                return $result . "Rupees Only";
          }
        
    }
}
