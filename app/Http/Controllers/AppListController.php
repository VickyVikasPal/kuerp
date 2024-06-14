<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\AppList\AppList;
use App\Modules\AppList\GroupedNavbar;
use Illuminate\Support\Facades\Cache;
use App\Models\PdfSetting;
use App\Common\GlobalSettings;
use Illuminate\Support\Facades\Auth;
use App\Common\SoftdevController;

class AppListController extends SoftdevController
{
    public function getAppList(Request $req)
    {
        $this->LogInfo('Begin:AppLists.controller->getAppList()');

        $applist = new GroupedNavbar();

        return response()->json($applist->Grouped_Header_Structure());
    }

    public function getHeader(Request $req)
    {
        $this->LogInfo('Begin:AppLists.controller->getHeader()');

        $headerlist = new GroupedNavbar();

        return response()->json($headerlist->Grouped_Header_Structure());
    }

    public function getPdfSettings(Request $req)
    {
        $this->LogInfo('Begin: AppLists.controller->getPdfSettings()');
        try
        {
            $current_user = Auth::user();
            $key = $req->get('key');
            $pdf_settings = GlobalSettings::getCache('pdf_settings');

            if (empty($pdf_settings))
            {
                Cache::remember('pdf_settings' . $current_user->branch_id, 100000, function () {
                    $user = Auth::user();
                    $data = PdfSetting::where('branch_id', $user->branch_id)->where('category', 'pdf')->select('name', 'value')->get()->toArray();
                    $result = [];
                    foreach ($data as $item)
                    {
                        $result[$item['name']] = $item['value'];
                    }
                    return $result;
                });
                $pdf_settings = GlobalSettings::getCache('pdf_settings');
            }
            $value = $pdf_settings[$key] ?? '';

            if ($key == 'upload_nabh_logo')
            {
                $value = $value ? '/uploads/pdf_setting/' . $value : config('config')['logo_path'];
            }

            $this->LogInfo('End: AppLists.controller->getPdfSettings()');

            return response()->json($value);
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: AppLists.controller->getPdfSettings()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to get records'], 500);
        }
    }
}
