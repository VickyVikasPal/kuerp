<?php
namespace App\Modules\SystemSettings;

use App\Models\SystemSettingStatus;
use App\Modules\SystemSettings\Resources\SystemSettingStatusResource;
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