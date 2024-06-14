<?php
namespace App\Modules\Users;

use App\Models\User;
use App\Models\LoggedUser;
use App\Modules\Users\Resources\UserResource;
use App\Modules\Users\Resources\LoggedResource;
use Config;

class ListView
{
    public function getDatas($request)
    {
        $user = new User();

       /* try
        {*/
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
           // $sort = json_decode($request->get('sort', json_encode(['order' => 'desc', 'column' => 'date_entered'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
           $sort = $request->get('sort');
            if (count($dateArr) > 0)
            {
                $dateRange = [$dateArr[0], $dateArr[1]];

                $items = User::where($next_array)
                    ->whereBetween($dateKey, $dateRange)
                    ->orderBy($sort['column'], $sort['order'])
                    ->paginate((int)$request->get('perPage', 10));

            }
            else
            {
                $items = User::where($next_array)
                    ->orderBy($sort['column'], $sort['order'])
                    ->paginate((int)$request->get('perPage', 10));
            }

            $user->LogDebug('End: Users.ListView->getDatas()', ['count' => count($items)]);

            $array = [
                'items' => UserResource::collection($items->items()),
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
            $user->LogCritical('Failed: Users.ListView->getDatas()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve items'], 500);
        }*/
    }
    public function export($request)
    {
        $user = new User();
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

                    $items = User::where($next_array)
                        ->whereBetween($dateKey, $dateRange)
                        ->orderBy($sort['column'], $sort['order'])
                        ->paginate(PHP_INT_MAX);

                }
                else
                {
                    $items = User::where($next_array)
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

                    $items = User::where($next_array)
                        ->whereIn('id', $request->get('ids'))
                        ->whereBetween($dateKey, $dateRange)
                        ->orderBy($sort['column'], $sort['order'])
                        ->paginate(PHP_INT_MAX);

                }
                else
                {
                    $items = User::where($next_array)
                        ->whereIn('id', $request->get('ids'))
                        ->orderBy($sort['column'], $sort['order'])
                        ->paginate(PHP_INT_MAX);
                }
            }
            $user->LogDebug('End: Users.ListView->export()', ['count' => count($items)]);

            $array = UserResource::collection($items->items());
            return json_encode($array, true);
        }
        catch (\Throwable $e)
        {
            $user->LogCritical('Failed: Users.ListView->export()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve records'], 500);
        }
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
    }

    public function getLoggedIn($request)
    {
        $user = new User();
        try
        {
            $sort = json_decode($request->get('sort', json_encode(['order' => 'desc', 'column' => 'date_entered'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);

            $items = LoggedUser::filter($request->all())
                ->where('deleted', 0)
                ->where('logged_in', 1)
                ->orderBy($sort['column'], $sort['order'])
                ->paginate((int)$request->get('perPage', 10));

            $array = [
             'items' => LoggedResource::collection($items->items()),
             'pagination' => [
                 'currentPage' => $items->currentPage(),
                 'perPage' => $items->perPage(),
                 'total' => $items->total(),
                 'totalPages' => $items->lastPage()
             ]
             ];
            $user->LogDebug('End: Users.ListView->getLoggedIn()', ['count' => count($items)]);
            return response()->json($array, 200);
        }
        catch (\Throwable $e)
        {
            $user->LogCritical('Failed: Users.ListView->getLoggedIn()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve records'], 500);
        }
    }

    public function getLoggedOut($request)
    {
        $user = new User();
        try
        {
            $sort = json_decode($request->get('sort', json_encode(['order' => 'desc', 'column' => 'date_entered'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);

            $items = LoggedUser::filter($request->all())
                ->where('deleted', 0)
                ->where('logged_in', 0)
                ->orderBy($sort['column'], $sort['order'])
                ->paginate((int)$request->get('perPage', 10));

            $array = [
             'items' => LoggedResource::collection($items->items()),
             'pagination' => [
                 'currentPage' => $items->currentPage(),
                 'perPage' => $items->perPage(),
                 'total' => $items->total(),
                 'totalPages' => $items->lastPage()
             ]
            ];
            $user->LogDebug('End: Users.ListView->getLoggedOut()', ['count' => count($items)]);
            
            return response()->json($array, 200);
        }
        catch (\Throwable $e)
        {
            $user->LogCritical('Failed: Users.ListView->getLoggedOut()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve records'], 500);
        }
    }
}
