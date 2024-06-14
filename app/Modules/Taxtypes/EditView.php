<?php
namespace App\Modules\Taxtypes;

use App\Models\Taxtype;
use App\Common\Base64ToImage;
use App\Http\Resources\Taxtype\TaxtypeResource;
use App\Http\Requests\Dashboard\Admin\Taxtype\StoreRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use File;

class EditView{
    

    public function getEdit(StoreRequest $request){
   
    
    $taxtype = new Taxtype();
        
            $formData = $request->get('editFormData');
            $status_value = $formData['status'];

            $taxtype->name = $formData['name'];
            $taxtype->tax = $formData['tax'];
            $taxtype->description = $formData['description'];
            $taxtype->status = $status_value['value'];

   
         if ($taxtype->save()) {
            
            return response()->json(['message' => 'Data saved correctly', 'category' => new TaxtypeResource($taxtype)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
 

    }

}