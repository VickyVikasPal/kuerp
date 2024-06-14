<?php
namespace App\Modules\UserDashlets;

use App\Models\UserDashlet;
use App\Modules\UserDashlets\Resources\UserDashletResource;
use Illuminate\Support\Facades\DB;
use Auth;

class ListView
{
    public function getDatas($request)
    {
        $userdashlet = new UserDashlet();
        try
        {
            $sort = json_decode($request->get('sort', json_encode(['order' => 'asc', 'column' => 'date_entered'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
            if ($request->get('search') != '')
            {
                $items = Sequence::where('deleted', '=', '0')
                ->where('branch_id', '=', $request->get('search'))
                ->orderBy($sort['column'], $sort['order'])
                ->paginate((int)$request->get('perPage', 10));
            }
            else
            {
                $items = UserDashlet::where('deleted', '=', '0')
                ->orderBy($sort['column'], $sort['order'])
                ->paginate((int)$request->get('perPage', 10));
            }

            // return response()->json(['items' => SequenceResource::collection($items)]);
            $userdashlet->LogDebug('End: UserDashlets.ListView->getDatas()', ['count' => count($items)]);

            $array = [
             'items' => UserDashletResource::collection($items->items()),
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
            $userdashlet->LogCritical('Failed: UserDashlets.ListView->getDatas()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve records'], 500);
        }
    }
    public function export()
    {
        $ids = request()->input('ids') ?? '';
        $all = request()->input('all') ?? '';
        $items = UserDashlet::filter()->when(request()->input('all'), function ($query) {
        // return $query->whereIn('id', 'desc');
        }, function ($items) {
            return $items->whereIn('id', request()->input('ids'));
        })->where('deleted', null)->where('branch_id', null)->get();
        // return response()->json(['items' => UserResource::collection($query)]);

        $array = [
         'items' => UserDashletResource::collection($items->items()),
         'pagination' => [
             'currentPage' => $items->currentPage(),
             'perPage' => $items->perPage(),
             'total' => $items->total(),
             'totalPages' => $items->lastPage()
         ]
         ];
        return $array;
    }

    public function getUserDashlets($request)
    {
        $dashlet = new UserDashlet();

        $dashlet->LogInfo('Begin: UserDashlets.ListView->getUserDashlets()');

        if ($request->get('user_type') == 'Super Admin' || $request->get('user_type') == 'Admin')
        {
            $dashletSetup = DB::table('userdashletsetups')->where('status', '=', 'Active')->where('deleted', '=', '0')->select('left_width', 'right_width')->get();
            $userdashlet = DB::table('userdashlets')->where('status', '=', 'Active')->where('deleted', '=', '0')->where('show_dashlets', 1)->get();
        }
        else
        {
            $dashletSetup = DB::table('userdashletsetups')->where('status', 'Active')->where('deleted', '0')->where('user_type', $request->get('user_type'))->select('left_width', 'right_width')->get();
            $userdashlet = DB::table('userdashlets')->where('status', 'Active')->where('deleted', '0')->where('show_dashlets', 1)->where('user_type', $request->get('user_type'))->get();
        }

        $data = array();
        foreach ($userdashlet as $key => $value)
        {

            $dashlet_data = DB::table('userdashlets')
                        ->Join('userdashletconfigs', 'userdashlets.id', '=', 'userdashletconfigs.dashlet_id')
                        ->where('userdashlets.show_dashlets', 1)
                        ->where('userdashlets.deleted', '0')
                        /* ->where('userdashlets.graph_view', '1') */
                        ->where('userdashlets.user_type', $request->get('user_type'))
                        ->select('userdashletconfigs.id', 'userdashletconfigs.name', 'userdashletconfigs.user_type', 'userdashletconfigs.graph_type')
                        ->get();
        }
        $data = array('dashlet_data' => $dashlet_data, 'dashlet_setup' => $dashletSetup);

        $dashlet->LogDebug('End: UserDashlets.ListView->getUserDashlets()', ['user_id' => $request->user()->id]);

        return $data;
    }

    public function getDashletTables($request)
    {
        $dashlet = new UserDashlet();

        $dashlet->LogInfo('Begin: UserDashlets.ListView->getDashletTables()');

        $user = Auth::user();
        $dashletRequest = $request->all();

        $tableName = strtolower($dashletRequest['moduleName']);

        $dataQuery = DB::table($tableName)
                         ->where('deleted', 0)
                         ->where('branch_id', $user->branch_id)
                         ->addSelect('id');
        foreach ($dashletRequest['listName'] as $key => $value)
        {
            $dataQuery = $dataQuery->addSelect($value);
        }
        $dataQuery->orderByDesc('created_at');
        $dataQuery->limit(5);
        $data = $dataQuery->get();

        $dashlet->LogDebug('End: UserDashlets.ListView->getDashletTables()', ['user_id' => $request->user()->id]);
    }

    public function getGraphContent($request)
    {
        $dashlet = new UserDashlet();
        $dashlet->LogInfo('Begin: UserDashlets.ListView->getDashletTables()');

        $user = Auth::user();
       // echo $request->moduleName;
       $tableName = strtolower($request->moduleName);
        $col_value = $request->cal_value;
        $col_name = $request->columns;
        
       $data = array();
      
        foreach ($col_value as $key => $calvalue) {
            $dataQuery = DB::table($tableName)
            ->where('deleted', 0)
            ->where('branch_id', $user->branch_id);
            foreach ($col_name as $colkey => $colName) {
                $dataQuery =  $dataQuery->where($colName,$calvalue);
            }
            $dataQuery = $dataQuery->get();
            $dataCount = $dataQuery->count();
            $data[$key]=$dataCount;
           }
            
       //print_r($data);

      return $data;
    }
}
