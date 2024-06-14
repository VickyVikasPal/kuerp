<?php
namespace App\Modules\PdfSettings;

use App\Models\PdfSettingStatus;
use App\Modules\PdfSettings\Resources\PdfSettingStatusResource;
use App\Common\Datetime\TimeDate;

class ListView
{
    public function getDatas($request)
    {
        
    }
    public function isDate($value)
    {
        if (!$value) {
            return false;
        }

        try {
            new \DateTime($value);
            return true;
        }
        catch (\Exception $e) {
            return false;
        }
    }

    public function export($request)
    {
        
    }
}