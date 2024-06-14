<?php
namespace App\Modules\ClientMasters;

use App\Models\ClientMaster;
use App\Common\Base64ToImage;
use App\Modules\ClientMasters\Resources\ClientMasterResource;
use App\Modules\ClientMasters\Requests\UpdateRequest;

class DetailView{

    public function get_details(UpdateRequest $request, ClientMaster $clientmaster){

       // $selectbox_value = $request->get('select');
      
            $formData = $request->get('editFormData');
            $status_value = $formData['status'];

            $clientmaster = ClientMaster::find($formData['id']);

            $clientmaster->name = $formData['name'];
            
            $clientmaster->firm_name = $formData['firm_name'];
            $clientmaster->contact_no = $formData['contact_no'];
            $clientmaster->client_email = $formData['client_email'];
            $clientmaster->gst_status = $formData['gst_status'];
            $clientmaster->gst_number = strtoupper($formData['gst_number']);
            $clientmaster->address = $formData['address'];
            $clientmaster->area = $formData['area'];
            $clientmaster->state = $formData['state'];
            $clientmaster->pin_no = $formData['pin_no'];
            $clientmaster->status = 1;
        if ($clientmaster->save()) {
            return array('message'=>'success');
        }else{
            return array('message'=>'fail');
        }
        
    }
}