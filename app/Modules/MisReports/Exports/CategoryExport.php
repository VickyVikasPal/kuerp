<?php
namespace App\Modules\MisReports\Exports;

use App\Models\User;
use App\Models\LoggedUser;
use App\Modules\MisReports\Resources\UserResource;
use App\Modules\MisReports\Resources\LoggedResource;
use App\Common\Datetime\TimeDate;
use Config;
use DB;
use Auth;

class CategoryExport
{
    public function category_wise_data($request)
    {
        /* print_r($request->all());
        print_r($request->formData['category_id']); 
        die;*/

        $user = Auth::user();
        $dateTime = new TimeDate();
        if($request->fileType == 'excel'){
            $fileName = $request->reportName.'.csv';
            if(isset($request->formData['date_range1']) && isset($request->formData['date_range2']))
            {
            $date_range1 = $dateTime->to_db_datetime($request->formData['date_range1']);
            
            $date_range2 = $dateTime->to_db_datetime($request->formData['date_range2']);
        }
            $datas = DB::table('categorys')
                        ->leftJoin('subcategorys', 'categorys.id', '=', 'subcategorys.parent_id')
                        ->leftJoin('products', 'categorys.id', '=', 'products.parent_id')
                        ->select('categorys.name as category_name', 'subcategorys.name as subcategory_name', 'products.name as product_name', 'products.price as product_price')
                        ->where('products.status','Active')
                        ->where('products.deleted',0)
                        ->where('categorys.id', $request->formData['category_id'])
                        ->where('products.branch_id', $user->branch_id)
                        ->get();

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array('Category Name', 'Sub Category', 'Product Name', 'Product Price');

            $callback = function() use($datas, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($datas as $data) {
                    $row['category_name']  = $data->category_name;
                    $row['subcategory_name']    = $data->subcategory_name;
                    $row['product_name']    = $data->product_name;
                    $row['product_price']  = $data->product_price;

                    fputcsv($file, array($row['category_name'], $row['subcategory_name'], $row['product_name'], $row['product_price']));
                }

                //fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
    }
}
