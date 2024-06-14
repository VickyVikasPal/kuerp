<?php

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Models\UserRole;
use App\Models\UserRoleAction;
use App\Modules\UserRoles\DetailView;
use App\Modules\UserRoles\EditView;
use App\Modules\UserRoles\ListView;
use App\Modules\UserRoles\Requests\StoreRequest;
use App\Modules\UserRoles\Requests\UpdateRequest;
use App\Modules\UserRoles\Resources\UserRoleResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use JsonException;
use Log;
use Route;

class UserRoleController extends SoftdevController
{
    public $module_dir = 'UserRole';

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}

    public $export_field = array(
    'name' => 'Role Name',
    'status' => 'Status',
    );

    public function __construct()
    {
        $this->LogDebug('UserRoleController initialized');

        $this->middleware('auth:sanctum');

        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);

        $table_name = new UserRole();

        parent::assignTable($table_name->table);

    }
    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: UserRoles.controller->index()');

        $listview = new ListView();

        return $listview->getDatas($request);

    }
    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: UserRoles.controller->store()');

        $editview = new EditView();

        return $editview->addData($request);
    }
    public function show(UserRole $userRole, $id): JsonResponse
    {
        $this->LogInfo('Begin: UserRoles.controller->show()');

        try
        {
            return response()->json(new UserRoleResource(UserRole::findOrFail($id)));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: UserRoles.controller->show()', ['record_id' => $userRole->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
    public function update(UpdateRequest $request, UserRole $userRole, $id): JsonResponse
    {
        $this->LogInfo('Begin: UserRoles.controller->update()');

        $request->validated();

        $detailview = new DetailView();

        return $detailview->updateData($request, $userRole, $id);
    }

    /* 
     public function users(): JsonResponse
     {
     return response()->json(UserRoleResource::collection(UserRole::all()));
     } */
    public function export($request)
    {
        $this->LogInfo('Begin: UserRoles.controller->export()');

        $user_list = new ListView();
        return $user_list->export($request);
    }
    public function getChangeLogs($id, UserRole $userRole): JsonResponse
    {
        $this->LogInfo('Begin: UserRoles.controller->getChangeLogs()');

        $detailview = new DetailView();
        return response()->json($detailview->getAuditDatas($id, $userRole));
    }
    public function permissions(UserRole $userRole, Request $request): JsonResponse
    {
        $this->LogInfo('Begin: UserRoles.controller->permissions()');

        $modules = [];
        foreach (Route::getRoutes()->getIterator() as $route)
        {
            if ((strpos($route->uri, 'modules') !== false) && !empty($route->action['controller']))
            {
                $path = explode('@', str_replace($route->action['controller'] . '\\', '', $route->action['controller']))[0];
                $module = str_replace(['App\\Http\\Controllers\\Api\\', 'Controller', '\\'], '', $path);
                if (!\in_array($module, $modules) || empty($modules))
                {
                    $modules[] = $module;
                }
            }
        }

        sort($modules);

        $permissions = UserRoleAction::where('parent_id', $request->input('parent_id'))
        ->where('name', '!=', null)
        ->where('deleted', 0)
        ->get();

        // Prepare the permission array
        $permission_array = [];
        foreach ($modules as $module)
        {
            $value = $permissions->firstWhere('name', $module);
            $permission_array[] = [
                'module' => $module,
                'id' => optional($value)->id,
                'access' => optional($value)->access,
                'delete' => optional($value)->delete,
                'export' => optional($value)->export,
                'list' => optional($value)->list,
                'edit' => optional($value)->edit,
                'view' => optional($value)->view,
            ];
        }

        return response()->json(['modules' => $modules, 'permission' => $permission_array], 200);
    }
    public function permissionsOLD(UserRole $userRole, Request $request): JsonResponse
    {
        $this->LogInfo('Begin: UserRoles.controller->permissions()');

        $modules = [];
        foreach (Route::getRoutes()->getIterator() as $route)
        {
            if ((strpos($route->uri, 'modules') !== false) && !empty($route->action['controller']))
            {
                $path = explode('@', str_replace($route->action['controller'] . '\\', '', $route->action['controller']))[0];
                $module = str_replace(['App\\Http\\Controllers\\Api\\', 'Controller', '\\'], '', $path);
                if (!\in_array($module, $modules) || empty($modules))
                {
                    $modules[] = $module;
                }
            }
        }
        $permission = UserRoleAction::where('parent_id', $request->get('parent_id'))->where('name', '!=', null)->where('deleted', '=', 0)->get();

        $permission_array = array();

        sort($modules);
        for ($i = 0; $i < count($modules); $i++)
        {

            if (count($permission) < 1)
            {
                array_push($permission_array, ['module' => $modules[$i], 'id' => '', 'access' => '', 'delete' => '', 'export' => '', 'list' => '', 'edit' => '', 'view' => '']);
            }
            else
            {
                $value = UserRoleAction::where('parent_id', $request->get('parent_id'))->where('name', $modules[$i])->where('deleted', '=', 0)->first();
                $permission_array[] = array(
                    'module' => $modules[$i],
                    'id' => $value->id ?? '',
                    'access' => $value->access ?? '',
                    'delete' => $value->delete ?? '',
                    'export' => $value->export ?? '',
                    'list' => $value->list ?? '',
                    'edit' => $value->edit ?? '',
                    'view' => $value->view ?? '',
                );

            // foreach ($permission as $key => $value)
            // {
            //     if ($modules[$i] == $value->name)
            //     {
            //         array_push($permission_array, ['module' => $modules[$i], 'id' => $value->id, 'access' => $value->access, 'delete' => $value->delete, 'export' => $value->export, 'list' => $value->list, 'edit' => $value->edit, 'view' => $value->view]);
            //     }
            // }


            }
        }

        return response()->json(['modules' => $modules, 'permission' => $permission_array], 200);
    }
}
