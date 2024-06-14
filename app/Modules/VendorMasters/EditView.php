<?php
namespace App\Modules\VendorMasters;

use App\Models\VendorMaster;
use App\Common\Base64ToImage;
use App\Modules\VendorMasters\Resources\VendorMasterResource;
use App\Modules\VendorMasters\Requests\StoreRequest;
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
      
        $vendormaster = new VendorMaster();
        $generateKey = new Utils();
        $datetime = new TimeDate();
       $currentdate = $datetime->get_gmt_db_datetime();
       $options = array('tableName'=>$vendormaster->table, 'dateField'=>$currentdate);
     /*   $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);*/
        $seqNO = $generateKey->autoGenerateKey($options);

        $vendormaster->name = $request->name;
        $vendormaster->vendor_id = $seqNO;
        $vendormaster->firm_name = $request->firm_name;
        $vendormaster->contact_no = $request->contact_no;
        $vendormaster->vendor_email = $request->vendor_email;
        $vendormaster->gst_status = $request->gst_status;
        $vendormaster->gst_number = strtoupper($request->gst_number);
        $vendormaster->address = $request->address;
        $vendormaster->area = $request->area;
        $vendormaster->state = $request->state;
        $vendormaster->pin_no = $request->pin_no;
        $vendormaster->status = 1;
       
        //print_r($vendormaster);
        if($vendormaster->save()){
            return response()->json(['message' => 'Data saved correctly', 'vendormaster' => new VendorMasterResource($vendormaster)]);
        }else{
            return response()->json(['message' => __('An error occurred while saving data')], 500);
 
        }
    }

}