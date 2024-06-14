<?php
namespace App\Modules\SubCategorys;

use App\Models\SubCategory;
use App\Common\Base64ToImage;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Http\Requests\Dashboard\Admin\SubCategory\StoreRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use File;

class EditView{

    public function getEdit(StoreRequest $request){
   
      
    $subcategory = new SubCategory();
        
            $formData = $request->get('editFormData');
            $status_value = $formData['status'];

   
            $subcategory->name = $formData['name'];
            $subcategory->parent_id = $formData['parent_id'];
            $subcategory->parent_type = $formData['parent_type'];
            $subcategory->status = $status_value['value'];

        
   
         if ($subcategory->save()) {
            if($request->get('fileUpload') == true){
               $cat_id = $subcategory->id;
               $cat = SubCategory::find($cat_id);
                $file = $request->file('imagefile');
                
                $imagepath = Base64ToImage::base64ToImage($request->get('fileContent'), $cat_id.'.'.$request->get('fileExt'));
            
                $path = 'images';
                
                $cat->subcategory_image = $imagepath;

                $cat->save();
            }

            return response()->json(['message' => 'Data saved correctly', 'subcategory' => new SubCategoryResource($subcategory)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
 

    }

}