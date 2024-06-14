<?php

namespace App\Common;

class MISExport
{
    public function getReport($request, $reportName = '', $module_name = '')
    {
        $fileName = substr($module_name, 0, -1);
       
        //use App\Modules\MisReports\Exports\CategoryExport;
        $class = str_replace("::class", "", "App\Modules\MisReports\Exports\\" . $fileName."Export");
        $focus = new $class;

        $funName = $reportName;
        return $focus->$funName($request);
    }
}