<?php
namespace App\Modules\Payments;

use App\Models\Payment;
use App\Modules\Payments\Resources\PaymentResource;
use DB;

class ListView
{

    public function get_list($request)
    {

        $tableName = new Payment();

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
        //print_r($request->get('sort'));
     //   $sort = json_decode($request->get('sort', json_encode(['order' => 'asc', 'column' => 'created_at'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
     $sort = $request->get('sort');

        if (count($dateArr) > 0) {
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
        }
        $array = [
            'items' => PaymentResource::collection($items->items()),
            'pagination' => [
                'currentPage' => $items->currentPage(),
                'perPage' => $items->perPage(),
                'total' => $items->total(),
                'totalPages' => $items->lastPage(),
            ],
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
}