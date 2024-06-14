<?php
namespace App\Modules\Branchs;

use App\Models\Branch;
use App\Modules\Branchs\Resources\BranchResource;
use Illuminate\Http\Request;
use DB;

class ListView
{
    public function getDatas($request)
    {
        $branch = new Branch();
       // try
       // {
            $where = array();

            $next_array = array();
            $text = array();
            $dateArr = array();
            $dateKey = '';
            $where = ['deleted' => '0'];
            if ($request->get('search') != '')
            {
                $searchItems = json_decode($request->get('search'));
                foreach ($searchItems as $key => $value)
                {

                    if ($value != '' && !is_object($value))
                    {
                        if ($this->isDate($value) == true)
                        {
                            array_push($dateArr, date("Y-m-d h:i:s", strtotime($value)));
                            $key_date = explode("_", $key);
                            $dateKey = $key_date[0];
                        }
                        else
                        {
                            $text[$key] = $value;
                        }

                    }
                    else if ($value != '' && is_object($value))
                    {
                        $obj_value = get_object_vars($value);
                        $text[$key] = $obj_value['value'];
                    }
                    else
                    {

                    }
                }
            }

            $next_array = array_merge($where, $text);
            //$sort = json_decode($request->get('sort', json_encode(['order' => 'desc', 'column' => 'date_entered'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
            $sort = $request->get('sort');

            if (count($dateArr) > 0)
            {
                $dateRange = [$dateArr[0], $dateArr[1]];

                $items = Branch::where($next_array)
                    ->whereBetween($dateKey, $dateRange)
                    ->orderBy($sort['column'], $sort['order'])
                    ->paginate((int)$request->get('perPage', 10));

            }
            else
            {
                $items = Branch::where($next_array)
                    ->orderBy($sort['column'], $sort['order'])
                    ->paginate((int)$request->get('perPage', 10));
            }

            $branch->LogDebug('End: Branchs.ListView->getDatas()', ['count' => count($items)]);

            $array = [
                'items' => BranchResource::collection($items->items()),
                'pagination' => [
                    'currentPage' => $items->currentPage(),
                    'perPage' => $items->perPage(),
                    'total' => $items->total(),
                    'totalPages' => $items->lastPage()
                ]
            ];

            return response()->json($array, 200);
       /* }
        catch (\Throwable $e)
        {
            $branch->LogCritical('Failed: Branchs.ListView->getDatas()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve records'], 500);
        }*/
    }
    public function isDate($value)
    {
        if (!$value)
        {
            return false;
        }

        try
        {
            new \DateTime($value);
            return true;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }    /* 
     public function getBranchById($parent_id)
     {
     $data = Branch::where('parent_id', '=', $parent_id)->where('deleted', '=', '0')->get();
     return $data;
     }
     */
    public function export($request)
    {
        $branch = new Branch();
        try
        {
            $where = array();

            $next_array = array();
            $text = array();
            $dateArr = array();
            $dateKey = '';
            //   $request = request();
            $where = ['deleted' => '0'];
            if ($request->get('search') != '')
            {
                $searchItems = json_decode($request->get('search'));
                foreach ($searchItems as $key => $value)
                {

                    if ($value != '' && !is_object($value))
                    {
                        if ($this->isDate($value) == true)
                        {
                            array_push($dateArr, date("Y-m-d h:i:s", strtotime($value)));
                            $key_date = explode("_", $key);
                            $dateKey = $key_date[0];
                        }
                        else
                        {
                            $text[$key] = $value;
                        }

                    }
                    else if ($value != '' && is_object($value))
                    {
                        $obj_value = get_object_vars($value);
                        $text[$key] = $obj_value['value'];
                    }
                    else
                    {

                    }
                }
            }
            if (!empty($request->get('all')))
            {
                $next_array = array_merge($where, $text);
                $sort = json_decode($request->get('sort', json_encode(['order' => 'desc', 'column' => 'date_entered'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
                if (count($dateArr) > 0)
                {
                    $dateRange = [$dateArr[0], $dateArr[1]];

                    $items = Branch::where($next_array)
                        ->whereBetween($dateKey, $dateRange)
                        ->orderBy($sort['column'], $sort['order'])
                        ->paginate(PHP_INT_MAX);

                }
                else
                {
                    $items = Branch::where($next_array)
                        ->orderBy($sort['column'], $sort['order'])
                        ->paginate(PHP_INT_MAX);
                }
            }
            elseif (!empty($request->get('ids')))
            {
                $next_array = array_merge($where, $text);
                $sort = json_decode($request->get('sort', json_encode(['order' => 'desc', 'column' => 'date_entered'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
                if (count($dateArr) > 0)
                {
                    $dateRange = [$dateArr[0], $dateArr[1]];

                    $items = Branch::where($next_array)
                        ->whereIn('id', $request->get('ids'))
                        ->whereBetween($dateKey, $dateRange)
                        ->orderBy($sort['column'], $sort['order'])
                        ->paginate(PHP_INT_MAX);

                }
                else
                {
                    $items = Branch::where($next_array)
                        ->whereIn('id', $request->get('ids'))
                        ->orderBy($sort['column'], $sort['order'])
                        ->paginate(PHP_INT_MAX);
                }
            }

            $array = BranchResource::collection($items->items());

            return json_encode($array, true);
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $branch->LogCritical('Failed to export records', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to export records'], 500);
        }
    }

    public function getActiveBranch()
    {
        $data = Branch::where('status', '=', 'Active')->where('deleted', '=', '0')->get();
        return $data;
    }
}