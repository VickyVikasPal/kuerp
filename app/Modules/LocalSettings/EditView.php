<?php
namespace App\Modules\LocalSettings;

use App\Models\LocalSetting;
use App\Common\Base64ToImage;
use App\Modules\LocalSettings\Resources\LocalSettingResource;
use App\Modules\LocalSettings\Requests\StoreRequest;
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
        $localsetting = new LocalSetting();
        try
        {
            $branch_id = Auth::User()->branch_id;
            $keyValuePairs = $request->all();
            foreach ($keyValuePairs as $key => $value)
            {
                $existingRecord = LocalSetting::where('branch_id', $branch_id)
                    ->where('category', 'local')
                    ->where('name', $key)
                    ->first();
                if ($existingRecord)
                {
                    DB::table($localsetting->table)
                        ->where('branch_id', $branch_id)
                        ->where('category', 'local')
                        ->where('name', $key)
                        ->update(['value' => $value]);
                }
                else
                {
                    // If the record does not exist, insert a new record
                    $newRecord = new LocalSetting();
                    $newRecord->branch_id = $branch_id;
                    $newRecord->category = 'local';
                    $newRecord->name = $key;
                    $newRecord->value = $value;
                    $newRecord->save();
                }

            }
            $localsetting->LogInfo('End: LocalSettings.EditView->addData()', ['user_id' => $request->user()->id]);
            return response()->json(['message' => 'Data saved correctly']);
        }
        catch (\Throwable $e)
        {
            $localsetting->LogCritical('Failed: LocalSettings.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create Record'], 500);
        }


    }

}