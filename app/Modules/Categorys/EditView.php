<?php
namespace App\Modules\Categorys;

use App\Models\Category;
use App\Common\Base64ToImage;
use App\Modules\Categorys\Resources\CategoryResource;
use App\Modules\Categorys\Requests\StoreRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use File;
use Cache;
Use Auth;
use App\Http\Controllers\CustomCode;

class EditView{

    public function addData(StoreRequest $request){
      $user = Auth::user();
      
        $category = new Category();
       
        $validated = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        
        $category->name = $request->name;
        $category->status = $request->status;
        $category->branch_id = $user->branch_id;
        //print_r($category);
        if($category->save()){
            return response()->json(['message' => 'Data saved correctly', 'category' => new CategoryResource($category)]);
        }else{
            return response()->json(['message' => __('An error occurred while saving data')], 500);
 
        }
    }

}