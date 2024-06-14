<?php
namespace App\Modules\ClientMasters;

use App\Models\ClientMaster;
use App\Common\Base64ToImage;
use App\Modules\ClientMasters\Resources\ClientMasterResource;
use App\Modules\ClientMasters\Requests\StoreRequest;
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
      
        $clientmaster = new ClientMaster();
        $generateKey = new Utils();
        $datetime = new TimeDate();
       $currentdate = $datetime->get_gmt_db_datetime();
       $options = array('tableName'=>$clientmaster->table, 'dateField'=>$currentdate);
     /*   $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);*/
        $seqNO = $generateKey->autoGenerateKey($options);

        $clientmaster->name = $request->name;
        $clientmaster->client_id = $seqNO;
        $clientmaster->firm_name = $request->firm_name;
        $clientmaster->contact_no = $request->contact_no;
        $clientmaster->client_email = $request->client_email;
        $clientmaster->gst_status = $request->gst_status;
        $clientmaster->gst_number = strtoupper($request->gst_number);
        $clientmaster->address = $request->address;
        $clientmaster->area = $request->area;
        $clientmaster->state = $request->state;
        $clientmaster->pin_no = $request->pin_no;
        $clientmaster->status = 1;
       
        //print_r($clientmaster);
        if($clientmaster->save()){
            return response()->json(['message' => 'Data saved correctly', 'clientmaster' => new ClientMasterResource($clientmaster)]);
        }else{
            return response()->json(['message' => __('An error occurred while saving data')], 500);
 
        }
    }

}