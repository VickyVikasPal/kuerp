<?php
namespace App\Modules\PdfSettings;

use App\Models\PdfSetting;
use App\Common\Base64ToImage;
use App\Modules\PdfSettings\Resources\PdfSettingResource;
use App\Modules\PdfSettings\Requests\UpdateRequest;

class DetailView{

    public function updateData(UpdateRequest $request, $pdfSetting){
      
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }
}