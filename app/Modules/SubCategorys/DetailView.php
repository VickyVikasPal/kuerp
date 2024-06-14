<?php
namespace App\Modules\SubCategorys;

use App\Models\SubCategory;
use App\Common\Base64ToImage;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Http\Requests\Dashboard\Admin\SubCategory\UpdateRequest;

class DetailView{

    public function get_details(UpdateRequest $request, SubCategory $subcategory){

       // $selectbox_value = $request->get('select');
      
            $formData = $request->get('editFormData');
            $status_value = $formData['status'];

   
            $subcategory->name = $formData['name'];
            $subcategory->parent_id = $formData['parent_id'];
            $subcategory->parent_type = $formData['parent_type'];
            $subcategory->status = $status_value;

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

            return array('message'=>'success');
        }else{
            return array('message'=>'fail');
        }
        
    }
}