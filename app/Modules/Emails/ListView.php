<?php
namespace App\Modules\Emails;

use App\Models\EmailStatus;
use App\Modules\Emails\Resources\EmailStatusResource;
use App\Common\Datetime\TimeDate;

class ListView
{
    public function getDatas($request)
    {
        $emailstatus = new EmailStatus();

        try
        {

            $datetime = new TimeDate();

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
                            array_push($dateArr, date("Y-m-d", strtotime($value)));
                            //array_push($dateArr, $datetime->to_db_date($value));
                            $key_date = explode("_", $key);
                            $dateKey = $key;
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
            //    print_r($dateArr);die;
            $sort = json_decode($request->get('sort', json_encode(['order' => 'desc', 'column' => 'date_entered'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
            if (count($dateArr) > 0)
            {
                if (empty($dateArr[1]))
                {
                    $dateArr[1] = $dateArr[0];
                }
                if (empty($dateArr[1]))
                {
                    $dateArr[1] = $dateArr[0];
                }
                $dateRange = [$dateArr[0], $dateArr[1]];

                $items = EmailStatus::where($next_array)
                    ->whereBetween($dateKey, $dateRange)
                    ->orderBy($sort['column'], $sort['order'])
                    ->paginate((int)$request->get('perPage', 10));

            }
            else
            {
                $items = EmailStatus::where($next_array)
                    ->orderBy($sort['column'], $sort['order'])
                    ->paginate((int)$request->get('perPage', 10));
            }

            $emailstatus->LogDebug('End: Emails.ListView->getDatas()', ['count' => count($items)]);
            
            $array = [
                'items' => EmailStatusResource::collection($items->items()),
                'pagination' => [
                    'currentPage' => $items->currentPage(),
                    'perPage' => $items->perPage(),
                    'total' => $items->total(),
                    'totalPages' => $items->lastPage()
                ]
            ];

            return response()->json($array, 200);

        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $emailstatus->LogCritical('Failed:  Emails.ListView->getDatas()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to export records'], 500);
        }
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
    }

    public function export($request)
    {
        $emailstatus = new EmailStatus();
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

                    $items = EmailStatus::where($next_array)
                        ->whereBetween($dateKey, $dateRange)
                        ->orderBy($sort['column'], $sort['order'])
                        ->paginate(PHP_INT_MAX);

                }
                else
                {
                    $items = EmailStatus::where($next_array)
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

                    $items = EmailStatus::where($next_array)
                        ->whereIn('id', $request->get('ids'))
                        ->whereBetween($dateKey, $dateRange)
                        ->orderBy($sort['column'], $sort['order'])
                        ->paginate(PHP_INT_MAX);

                }
                else
                {
                    $items = EmailStatus::where($next_array)
                        ->whereIn('id', $request->get('ids'))
                        ->orderBy($sort['column'], $sort['order'])
                        ->paginate(PHP_INT_MAX);
                }
            }

            $array = EmailStatusResource::collection($items->items());

            return json_encode($array, true);
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $emailstatus->LogCritical('Failed to export records', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to export records'], 500);
        }

    }

    public function getActiveEmail()
    {
        $data = EmailStatus::where('status', '=', 'Active')->where('deleted', '=', '0')->get();
        return $data;
    }
}