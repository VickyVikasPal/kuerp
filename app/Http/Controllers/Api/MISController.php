<?php

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Models\Category;
use App\Common\MISExport;

class MISController extends SoftdevController
{
    public function callCustomFunction(Request $request)
    {

        $this->LogInfo('Begin: MisReports.controller->callCustomFunction()');

        $funName = $request->functionName;

        $data = self::$funName();

        $this->LogDebug('End: MisReports.controller->callCustomFunction()',['data'=>$data]);

        return response()->json($data);
    }

    public function get_category_list()
    {
        $this->LogInfo('Begin: MisReports.controller->get_category_list()');

        $user = Auth::user();

        $data = Category::select('id', 'name')->where('status', 'Active')->where('branch_id', $user->branch_id)->get();

        $this->LogDebug('End: MisReports.controller->get_category_list()',['data'=>$data]);

        return $data;
    }

    public function generateReport(Request $request)
    {   
        $mis_reports = '';
        
        $this->LogInfo('Begin: MisReports.controller->generateReport()');

        /* if($request->moduleName =='Categorys')
        {
            $mis_reports = new CategoryExport();
        }

        if($request->moduleName =='Products')
        {
            $mis_reports = new ProductExport();
        }
        
        $funName = $request->reportName;

        $this->LogDebug('End: MisReports.controller->get_category_list()');
 */
        $mis_export = new MISExport();
        return $mis_export->getReport($request, $request->reportName, $request->moduleName);
    }
}
