<?php
namespace App\Modules\LocalSettings;

use App\Models\LocalSetting;
use App\Common\Base64ToImage;
use App\Modules\LocalSettings\Resources\LocalSettingResource;
use App\Modules\LocalSettings\Requests\UpdateRequest;

class DetailView{

    public function updateData(UpdateRequest $request, $localSetting){
      
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }
}