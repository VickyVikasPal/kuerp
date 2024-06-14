<?php
namespace App\Modules\Quotations;

use App\Models\Product;
use App\Http\Resources\Product\ProductResource;
use App\Modules\Products\Requests\UpdateRequest;
use App\Common\Base64ToImage;

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

    public function get_details(UpdateRequest $request, Product $product){

       // $selectbox_value = $request->get('select');

       $formData = $request->get('editFormData');
    $product = Product::find($formData['id']);     
       $taxablePrice = round($formData['unit_price']/(($formData['tax_type']+100)/100), PHP_ROUND_HALF_UP);
       $taxableAmt = number_format((float)$taxablePrice, 2, '.', '');
       $totalTax = round($formData['unit_price']-($taxablePrice), PHP_ROUND_HALF_UP);
       $taxAmt = number_format((float)$totalTax, 2, '.', '');
       $tax = round($totalTax/2, PHP_ROUND_HALF_UP);
       $tax1 = number_format((float)$tax, 2, '.', '');
             
       $product->parent_id=$formData['parent_id'];
       $product->parent_type=$formData['parent_type'];
       $product->brand_name=$formData['product_brand'];
       $product->name = $formData['name'];
       $product->product_code = $formData['product_code'];
       $product->product_name = $formData['name'];
       $product->product_qty = $formData['product_qty'];
       $product->product_unit = $formData['product_unit'];
       $product->hsn_sac_code = $formData['hsn_code'];
       $product->tax_type = $formData['tax_type'];
       $product->taxable_price = $taxablePrice;
       $product->cgst = $tax1;
       $product->sgst = $tax1;
       $product->igst = $taxAmt;
       $product->unit_price = $formData['unit_price'];
       $product->description = $formData['description'];
       $product->status = $formData['status'];  
        if ($product->save()) {

            return array('message'=>'success');
        }else{
            return array('message'=>'fail');
        }
        
    }
}