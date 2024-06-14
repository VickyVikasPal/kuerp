<?php
namespace App\Modules\Taxtypes;

use App\Models\Taxtype;
use App\Common\Base64ToImage;
use App\Http\Resources\Taxtype\TaxtypeResource;
use App\Http\Requests\Dashboard\Admin\Taxtype\UpdateRequest;

class DetailView{

    public function get_details(UpdateRequest $request, Taxtype $taxtype){

       // $selectbox_value = $request->get('select');
      
            $formData = $request->get('editFormData');
            $status_value = $formData['status'];

            $taxtype->name = $formData['name'];
            $taxtype->tax = $formData['tax'];
            $taxtype->description = $formData['description'];
            $taxtype->status = $status_value;

        if ($taxtype->save()) {

            return array('message'=>'success');
        }else{
            return array('message'=>'fail');
        }
        
    }
}