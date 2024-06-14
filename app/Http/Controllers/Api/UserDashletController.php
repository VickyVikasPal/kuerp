<?php

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Models\UserDashlet;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\UserDashlets\Requests\StoreRequest;
use App\Modules\UserDashlets\Requests\UpdateRequest;
use App\Modules\UserDashlets\Resources\UserDashletResource;
use App\Modules\UserDashlets\ListView;
use App\Modules\UserDashlets\DetailView;
use App\Modules\UserDashlets\EditView;
use DB;
class UserDashletController extends SoftdevController
{
    public function __construct()
    {
        $this->LogDebug('UserDashletController initialized');

        $this->middleware('auth:sanctum');
        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }
    
    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: UserDashlets.controller->index()');

        $dashlet = new ListView();

        return $dashlet->getDatas($request);

    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: UserDashlets.controller->store()');

        $edit = new EditView();

        return $edit->addData($request);
    }

    public function show(UserDashlet $userdashlet): JsonResponse
    {
        $this->LogInfo('Begin: UserDashlets.controller->show()');

        try
        {
            return response()->json(new UserDashletResource($userdashlet));
        }
        catch (\Throwable $e)
        {
            $this->LogCritical('Failed: UserDashlets.controller->show()', ['record_id' => $userdashlet->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
    
    public function update(UpdateRequest $request, UserDashlet $userdashlet): JsonResponse
    {
        $this->LogInfo('Begin: UserDashlets.controller->update()');
        
        $detail = new DetailView();

        return $detail->updateData($request, $userdashlet);
    }
    public function getWidgets(Request $request)
    {
        $this->LogInfo('Begin: UserDashlets.controller->getWidgets()');

        if ($request->get('user_type') == 'Super Admin' || $request->get('user_type') == 'Admin')
        {
            $userdashlet = UserDashlet::where('status', '=', 'Active')->where('deleted', '=', '0')->get();
        }
        else
        {
            $userdashlet = UserDashlet::where('status', 'Active')->where('deleted', '0')->where('user_type', $request->get('user_type'))->get();
        }

        $this->LogDebug('End: UserDashlets.DetailView->getWidgets()', ['user_id' => $request->user()->id]);

        return response()->json($userdashlet);
    }

    public function updateWidgets(Request $request)
    {
        $this->LogInfo('Begin: UserDashlets.controller->updateWidgets()');

        $updateDashletSetup = new EditView();

        return $updateDashletSetup->updateDashletSetup($request);
    }

    public function showDashlets(Request $request)
    {
        $this->LogInfo('Begin: UserDashlets.controller->showDashlets()');

        $showDashlet = new ListView();

        return $showDashlet->getUserDashlets($request);
    }

    public function getDashletTable(Request $request)
    {
        $this->LogInfo('Begin: UserDashlets.controller->getDashletTable()');

        $showDashletTable = new ListView();
        
        return  $showDashletTable->getDashletTables($request);
    }
    public function remove(Request $request)
    {
        $userdashlet=UserDashlet::find($request->get('delete_id'));
        $userdashlet->deleted = '1';
        $userdashlet->save();
        DB::table('userdashletconfigs')->where('dashlet_id',$request->get('delete_id'))->update(array('deleted'=>'1'));
        return response()->json(['message' => 'Data deleted successfully']);
    }
    public function graphData(Request $request)
    {
        $this->LogInfo('Begin: UserDashlets.controller->graphData()');

        $getGraphData = new ListView();
        
        return  $getGraphData->getGraphContent($request);
    }
}
