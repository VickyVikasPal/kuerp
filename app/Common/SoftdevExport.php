<?php
namespace App\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\SoftdevCheckRolePermission;
use App\Common\SoftdevLog;

class SoftdevExport
{
    use SoftdevLog;
    public function export(Request $request)
    {
        $request->validate([
            'module' => 'required|string',
        ]);

        $this->LogInfo('Begin: app->common->SoftdevExport->export()');

        $records = $request->get('ids') ?? '';

        $all = $request->get('all') ?? '';

        $module = rtrim($request->get('module'), "s") . 'Controller';

        if (!file_exists(app_path('Http/Controllers/Api/' . $module . '.php')))
        {
            return "this module Controller file does not exist.please contact to administrator!";
        }

        $class = str_replace("::class", "", "App\Http\Controllers\Api\\" . $module);

        $focus = new $class;

        try
        {
            $tCRolPermission = new SoftdevCheckRolePermission();

            if (!$tCRolPermission->checkAccess('export', $request->module))
            {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'You don\'t have permission to access this page. Please contact your administrator.',
                ], 403);
            }

            $fileName = 'results.csv';

            if (empty($all) && empty($records))
            {
                return 'please select the row!';
            }

            $headers = array(
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0",
            );

            $results = $focus->export($request);

            $responseData = $results->getData();

            $results = $responseData->items;

            if (empty($results))
            {
                return "no record found!";
            }

            $columns = array_values($focus->export_field);

            $fieldname = array_keys($focus->export_field);

            $callback = function () use ($results, $columns, $fieldname) {

                $file = fopen('php://output', 'w');

                fputcsv($file, $columns);
                
                foreach ($results as $item)
                {
                    $field = [];
                    foreach ($fieldname as $fieldKey)
                    {
                        $field[] = $item->$fieldKey ?? '';
                    }
                    fputcsv($file, $field);
                }
            };

            $this->LogInfo('End: app->common->SoftdevExport->export()');

            return response()->stream($callback, 200, $headers);
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: app->common->SoftdevExport->export()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to export records'], 500);
        }

    }
}
