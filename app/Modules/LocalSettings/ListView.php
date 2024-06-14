<?php
namespace App\Modules\LocalSettings;

use App\Models\LocalSettingStatus;
use App\Modules\LocalSettings\Resources\LocalSettingStatusResource;
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