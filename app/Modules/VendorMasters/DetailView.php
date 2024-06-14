<?php
namespace App\Modules\VendorMasters;

use App\Models\VendorMaster;
use App\Common\Base64ToImage;
use App\Modules\VendorMasters\Resources\VendorMasterResource;
use App\Modules\VendorMasters\Requests\UpdateRequest;

class DetailView{

    public function get_details(UpdateRequest $request, VendorMaster $vendormaster){

       // $selectbox_value = $request->get('select');
      
            $formData = $request->get('editFormData');
            $status_value = $formData['status'];

            $vendormaster = VendorMaster::find($formData['id']);

            $vendormaster->name = $formData['name'];
            
            $vendormaster->firm_name = $formData['firm_name'];
            $vendormaster->contact_no = $formData['contact_no'];
            $vendormaster->vendor_email = $formData['vendor_email'];
            $vendormaster->gst_status = $formData['gst_status'];
            $vendormaster->gst_number = strtoupper($formData['gst_number']);
            $vendormaster->address = $formData['address'];
            $vendormaster->area = $formData['area'];
            $vendormaster->state = $formData['state'];
            $vendormaster->pin_no = $formData['pin_no'];
            $vendormaster->status = 1;
        if ($vendormaster->save()) {
            return array('message'=>'success');
        }else{
            return array('message'=>'fail');
        }
        
    }
}