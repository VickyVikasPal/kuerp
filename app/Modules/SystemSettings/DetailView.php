<?php
namespace App\Modules\SystemSettings;

use App\Models\SystemSetting;
use App\Common\Base64ToImage;
use App\Modules\SystemSettings\Resources\SystemSettingResource;
use App\Modules\SystemSettings\Requests\UpdateRequest;

class DetailView{

    public function updateData(UpdateRequest $request, $systemSetting){
      
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }
}