<?php
namespace App\Modules\PdfSettings;

use App\Models\PdfSetting;
use App\Common\Base64ToImage;
use App\Modules\PdfSettings\Resources\PdfSettingResource;
use App\Modules\PdfSettings\Requests\StoreRequest;
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
        $pdfsetting = new PdfSetting();
        try
        {

            $imgfield_array = ['upload_logo', 'upload_nabh_logo', 'upload_login_logo', 'upload_login_background'];
            $branch_id = Auth::User()->branch_id;
            $keyValuePairs = $request->all();
            foreach ($keyValuePairs as $key => $value)
            {

                $newval = $value;
                if (in_array($key, $imgfield_array) && !empty($value) && empty(explode(';', $value)[1]))
                {
                    $newval = '';
                }
                if (in_array($key, $imgfield_array) && !empty($newval))
                {
                    $extension = explode('/', explode(':', explode(';', $value)[0])[1])[1];
                    $imagepath = Base64ToImage::base64ToImage($request->get($key), $key . '.' . $extension, 'uploads/pdf_setting');
                    $value = $imagepath;
                }

                $existingRecord = PdfSetting::where('branch_id', $branch_id)
                    ->where('category', 'pdf')
                    ->where('name', $key)
                    ->first();
                if ($existingRecord)
                {
                    DB::table($pdfsetting->table)
                        ->where('branch_id', $branch_id)
                        ->where('category', 'pdf')
                        ->where('name', $key)
                        ->update(['value' => $value]);
                }
                else
                {
                    // If the record does not exist, insert a new record
                    $newRecord = new PdfSetting();
                    $newRecord->branch_id = $branch_id;
                    $newRecord->category = 'pdf';
                    $newRecord->name = $key;
                    $newRecord->value = $value;
                    $newRecord->save();
                }

            }
            $pdfsetting->LogInfo('End: PdfSettings.EditView->addData()', ['user_id' => $request->user()->id]);
            return response()->json(['message' => 'Data saved correctly']);
        }
        catch (\Throwable $e)
        {
            $pdfsetting->LogCritical('Failed: PdfSettings.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create Record'], 500);
        }

    }

}