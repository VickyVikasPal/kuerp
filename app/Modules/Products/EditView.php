<?php
namespace App\Modules\Products;

use App\Models\Product;
use App\Common\Base64ToImage;
use App\Modules\Products\Resources\ProductResource;
use App\Modules\Products\Requests\StoreRequest;
use App\Common\Datetime\TimeDate;
use Carbon\Carbon;
use DB;

class EditView{

    public function getEdit(StoreRequest $request){

        $dateTime = new TimeDate();
      
        $product = new Product();

        /*$taxablePrice = round($request->get('unit_price')/(($request->get('tax_type')+100)/100), PHP_ROUND_HALF_UP);
        $taxableAmt = number_format((float)$taxablePrice, 2, '.', '');
        $totalTax = round($request->get('unit_price')-($taxablePrice), PHP_ROUND_HALF_UP);
        $taxAmt = number_format((float)$totalTax, 2, '.', '');
        $tax = round($totalTax/2, PHP_ROUND_HALF_UP);
        $tax1 = number_format((float)$tax, 2, '.', '');*/

        $taxablePrice = $request->get('taxable_price');
        $taxableAmt = number_format((float)$taxablePrice, 2, '.', '');
        $totalTax = round(($request->get('unit_price')*$request->get('tax_type'))/100, PHP_ROUND_HALF_UP);
        $taxAmt = number_format((float)$totalTax, 2, '.', '');
        $tax = round($totalTax/2, PHP_ROUND_HALF_UP);
        $tax1 = number_format((float)$tax, 2, '.', '');
        $unitPrice = round(($taxablePrice +  $taxAmt), PHP_ROUND_HALF_UP);
              
        $product->parent_id=$request->get('parent_id');
        $product->parent_type=$request->get('parent_type')."s";
        $product->brand_name=$request->get('product_brand');
        $product->name = $request->get('name');
        $product->product_qty = $request->get('product_qty');
        $product->product_code = $request->get('product_code');
        $product->product_name = $request->get('name');
        $product->product_unit = $request->get('product_unit');
        $product->hsn_sac_code = $request->get('hsn_code');
        $product->tax_type = $request->get('tax_type');
        $product->taxable_price = $request->get('unit_price');
        $product->cgst = $tax1;
        $product->sgst = $tax1;
        $product->igst = $taxAmt;
        $product->unit_price = $unitPrice;
        $product->description = $request->get('description');
        $product->status = $request->get('status');        
              
        if ($product->save()) {

            return response()->json(['message' => 'Data saved correctly', 'product' => new ProductResource($product)]);
        }else{
        return response()->json(['message' => __('An error occurred while saving data')], 500);
        }

    }

    public function bulkUploads($request)
    {
     $data = $request->fileData;
     $msg = 0;
     for($i = 0; $i < count($data); $i++)
     {
        $cat = DB::table('categorys')->where('name', $data[$i]['CategoryName'])->where('deleted', 0)->where('status', 'Active')->select('id')->get();
        $catid = "";
        $catname = "categorys";
        if(count($cat) > 0){
            $catid = $cat[0]->id;
        }

        $product = new Product();

        $taxablePrice = round($data[$i]['SalePrice']/(($data[$i]['TaxType']+100)/100), PHP_ROUND_HALF_UP);
        $taxableAmt = number_format((float)$taxablePrice, 2, '.', '');
        $totalTax = round($data[$i]['SalePrice']-($taxablePrice), PHP_ROUND_HALF_UP);
        $taxAmt = number_format((float)$totalTax, 2, '.', '');
        $tax = round($totalTax/2, PHP_ROUND_HALF_UP);
        $tax1 = number_format((float)$tax, 2, '.', '');
              
        $product->parent_id= $catid;
        $product->parent_type=$catname;
        $product->brand_name=$data[$i]['BrandName'];
        $product->name = $data[$i]['ProductName'];
        $product->product_qty = $data[$i]['Qty'];
        $product->product_code = $data[$i]['ProductCode'];
        $product->product_name = $data[$i]['ProductName'];
        $product->product_unit = $data[$i]['Unit'];
        $product->hsn_sac_code = $data[$i]['HSNCode'];
        $product->tax_type = $data[$i]['TaxType'];
        $product->taxable_price = $taxablePrice;
        $product->cgst = $tax1;
        $product->sgst = $tax1;
        $product->igst = $taxAmt;
        $product->unit_price = $data[$i]['SalePrice'];
        $product->status = 'Active';        
              
        if ($product->save()) {
            $msg = 1;
        }else{
            $msg = 0;
            break;
        }
     }

     if ($msg == 1) {

        return response()->json(['message' => 'Data uploaded correctly'], 200);
    }else{
    return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    }

}