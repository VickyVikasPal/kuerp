<?php
namespace App\Modules\SystemSettings;

use App\Models\SystemSetting;
use App\Common\Base64ToImage;
use App\Modules\SystemSettings\Resources\SystemSettingResource;
use App\Modules\SystemSettings\Requests\StoreRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Auth;

class EditView
{
    public function addData(StoreRequest $request)
    {
        $systemsetting = new SystemSetting();
        try
        {
            $branch_id = Auth::User()->branch_id;
            $keyValuePairs = $request->all();
            foreach ($keyValuePairs as $key => $value)
            {
                $existingRecord = SystemSetting::where('branch_id', $branch_id)
                    ->where('category', 'system')
                    ->where('name', $key)
                    ->first();
                if ($existingRecord)
                {
                    DB::table($systemsetting->table)
                        ->where('branch_id', $branch_id)
                        ->where('category', 'system')
                        ->where('name', $key)
                        ->update(['value' => $value]);
                }
                else
                {
                    // If the record does not exist, insert a new record
                    $newRecord = new SystemSetting();
                    $newRecord->branch_id = $branch_id;
                    $newRecord->category = 'system';
                    $newRecord->name = $key;
                    $newRecord->value = $value;
                    $newRecord->save();
                }

            }
            $systemsetting->LogInfo('End: SystemSettings.EditView->addData()', ['user_id' => $request->user()->id]);
            return response()->json(['message' => 'Data saved correctly']);
        }
        catch (\Throwable $e)
        {
            $systemsetting->LogCritical('Failed: SystemSettings.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create Record'], 500);
        }


    }

}