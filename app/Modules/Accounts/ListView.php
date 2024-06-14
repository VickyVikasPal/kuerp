<?php
namespace App\Modules\Accounts;

use App\Models\Account;
use App\Modules\Accounts\Resources\AccountResource;
use Illuminate\Http\Request;
use DB;

class ListView
{
    public function getDatas($request)
    {
        
    }

    /**
     * Check if the value is a valid date
     *
     * @param mixed $value
     *
     * @return boolean
     */
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