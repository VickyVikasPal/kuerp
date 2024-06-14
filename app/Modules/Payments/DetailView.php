<?php
namespace App\Modules\Payments;

use App\Models\Payment;
use App\Models\Invoice;
use App\Common\Base64ToImage;
use App\Modules\Payments\Resources\PaymentResource;
use App\Modules\Payments\Requests\UpdateRequest;

class DetailView{

    public function get_details(UpdateRequest $request, Payment $payments){

       // $selectbox_value = $request->get('select');
      
            $formData = $request->get('editFormData');
            $status_value = $formData['status'];

            $payments = Payment::find($formData['id']);

            $payments->name = $formData['name'];
            $payments->status = $status_value;

        if ($payments->save()) {

            if($request->get('fileUpload') == true){
                $cat_id = $payments->id;
                $cat = Payment::find($cat_id);
                 $file = $request->file('imagefile');
                 
                 $imagepath = Base64ToImage::base64ToImage($request->get('fileContent'), $cat_id.'.'.$request->get('fileExt'));
             
                 $path = 'images';
                 
                 $cat->category_image = $imagepath;
 
                 $cat->save();
             }

            return array('message'=>'success');
        }else{
            return array('message'=>'fail');
        }
        
    }
}