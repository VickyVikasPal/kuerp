<?php

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Models\User;
use App\Models\UserRole;
use App\Modules\Users\DetailView;
use App\Modules\Users\EditView;
use App\Modules\Users\ListView;
use App\Modules\Users\Requests\StoreRequest;
use App\Modules\Users\Requests\UpdateRequest;
use App\Modules\Users\Resources\UserResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use JsonException;
use Log;

class UserController extends SoftdevController
{
    public $module_dir = 'User';

    public $table_name = '';

    public $export_field = array(
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'phone_mobile' => 'Phone',
        'user_name' => 'User Name',
        'user_role_name' => 'User Role',
        'status' => 'Status',
    );

    public function __construct()
    {
        $this->LogDebug('UserController initialized');

        $this->middleware('auth:sanctum');
        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);

        $table_name = new User();

        parent::assignTable($table_name->table);

    }
    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: Users.controller->index()');

        $user_list = new ListView();

        return $user_list->getDatas($request);

    }
    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: Users.controller->store()');

        $edit = new EditView();

        return $edit->addData($request);
    }
     /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function show(User $user, $id): JsonResponse
    {
       
        return response()->json(new UserResource(User::findOrFail($id)));
    }
    public function update(UpdateRequest $request, User $user): JsonResponse
    {
        $this->LogInfo('Begin: Users.controller->update()');

        $request->validated();

        $detail = new DetailView();

        return $detail->updateData($request, $user);
    }
    /* 
     public function users(): JsonResponse
     {
     return response()->json(UserResource::collection(User::all()));
     } */
    public function export($request)
    {
        $this->LogInfo('Begin: Users.controller->export()');

        $user_list = new ListView();

        return $user_list->export($request);
    }

    public function getLoggedInUser(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: Users.controller->getLoggedInUser()');

        $user_list = new ListView();

        return $user_list->getLoggedIn($request);
    }
    public function getLoggedOutUser(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: Users.controller->getLoggedOutUser()');

        $user_list = new ListView();

        return $user_list->getLoggedOut($request);
    }
    public function getChangeLogs($id, User $user): JsonResponse{

        $this->LogInfo('Begin: Users.controller->getChangeLogs()');

        $detailview = new DetailView();

        return response()->json($detailview->getAuditDatas($id, $user));
    }
}
