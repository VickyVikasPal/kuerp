<?php
namespace App\Modules\SubCategorys;

use App\Models\SubCategory;
use App\Http\Resources\SubCategory\SubCategoryResource;
use DB;

class ListView
{

    public function get_list($request)
    {
        
        $tableName = new SubCategory();

        $where = array();

        $next_array = array();
        $text = array();
        $dateArr = array();
        $dateKey = '';
        $where = ['deleted' => '0'];
        if ($request->get('search') != '') {
            $searchItems = json_decode($request->get('search'));
            foreach ($searchItems as $key => $value) {

                if ($value != '' && !is_object($value)) {
                    if ($this->isDate($value) == true) {
                        array_push($dateArr, date("Y-m-d h:i:s", strtotime($value)));
                        $key_date = explode("_", $key);
                        $dateKey = $key_date[0];
                    } else {
                        $text[$key] = $value;
                    }

                } else if ($value != '' && is_object($value)) {
                    $obj_value = get_object_vars($value);
                    $text[$key] = $obj_value['value'];
                } else {

                }
            }
        }

        $next_array = array_merge($where, $text);
        $startDate = '2023-04-03';
        $endDate = '2023-04-04';
        $sort = json_decode($request->get('sort', json_encode(['order' => 'desc', 'column' => 'created_at'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
        //$items = Product::where($next_array)

        if(count($dateArr)> 0){
        $dateRange = [$dateArr[0],$dateArr[1]];

        $items = SubCategory::where($next_array)
        ->whereBetween($dateKey, $dateRange)
        ->orderBy($sort['column'], $sort['order'])
        ->paginate((int) $request->get('perPage', 10)); 

         }
         else{
        $items = SubCategory::where($next_array)
        ->orderBy($sort['column'], $sort['order'])
        ->paginate((int) $request->get('perPage', 10)); 
         }

       /*  if (count($dateArr) > 0) {
            $dateRange = [$dateArr[0], $dateArr[1]];
            $items = DB::table($tableName->table)
                ->where($next_array)
                ->whereBetween($dateKey, $dateRange)
                ->orderBy($sort['column'], $sort['order'])
                ->paginate((int) $request->get('perPage', 10));
        } else {
            $dateRange = ['', ''];
            $items = DB::table($tableName->table)
                ->where($next_array)
                ->orderBy($sort['column'], $sort['order'])
                ->paginate((int) $request->get('perPage', 10));
        } */

        
        $array =   [
            'items' => SubCategoryResource::collection($items->items()),
            'pagination' => [
                'currentPage' => $items->currentPage(),
                'perPage' => $items->perPage(),
                'total' => $items->total(),
                'totalPages' => $items->lastPage()
            ]
            ];
        return $array;
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
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getSubCategoryById($parent_id){
        $data = SubCategory::where('parent_id','=',$parent_id)->where('deleted','=','0')->get();
        return $data;
    }
}
