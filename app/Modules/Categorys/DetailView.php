<?php
namespace App\Modules\Categorys;

use App\Models\Category;
use App\Common\Base64ToImage;
use App\Modules\Categorys\Resources\CategoryResource;
use App\Modules\Categorys\Requests\UpdateRequest;

class DetailView{

    public function get_details(UpdateRequest $request, Category $category){

       // $selectbox_value = $request->get('select');
      
            $formData = $request->get('editFormData');
            $status_value = $formData['status'];

            $category = Category::find($formData['id']);

            $category->name = $formData['name'];
            $category->status = $status_value;

        if ($category->save()) {

            if($request->get('fileUpload') == true){
                $cat_id = $category->id;
                $cat = Category::find($cat_id);
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