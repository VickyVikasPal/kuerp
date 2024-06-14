<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\Accounts\Requests\UpdatePasswordRequest;
use App\Modules\Accounts\Requests\UpdateRequest;
use App\Modules\Accounts\Resources\AccountResource;
use App\Models\Account;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Accounts\ListView;
use App\Modules\Accounts\DetailView;
use App\Modules\Accounts\EditView;

class AccountController extends SoftdevController
{

    public $module_dir = 'Account'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}


    public $export_field = array(
        'name' => 'Account Name',
        'account_code' => 'Account Code',
    );
    public function __construct()
    {
        $this->LogDebug('AccountController initialized');
        
        $table_name = new Account();

        $this->table_name = $table_name->table;

        $this->middleware('auth:sanctum');

        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }
    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: Accounts.controller->index()');

        $product = new ListView();

        return $product->getDatas($request);
    }
    public function show(Account $account): JsonResponse
    {
        $this->LogInfo('Begin: Accounts.controller->show()');

        $detail = new DetailView();

        return $detail->getData($account);
    }
    public function update(UpdateRequest $request, Account $account): JsonResponse
    {
        $this->LogInfo('Begin: Accounts.controller->update()');

        $detail = new DetailView();

        return $detail->updateData($request, $account);
    }

    public function updatePassword(UpdatePasswordRequest $request, Account $account): JsonResponse
    {
        $this->LogInfo('Begin: Accounts.controller->updatePassword()');

        $detail = new DetailView();

        return $detail->updatePassword($request, $account);
    }
    public function export($request)
    {
        $this->LogInfo('Begin: Accounts.controller->export()');

        $user_list = new ListView();
        
        return $user_list->export($request);
    }
}
