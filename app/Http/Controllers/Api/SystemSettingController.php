<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\SystemSettings\Requests\StoreRequest;
use App\Modules\SystemSettings\Requests\UpdateRequest;
use App\Modules\SystemSettings\Resources\SystemSettingResource;
use App\Models\SystemSetting;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\SystemSettings\ListView;
use App\Modules\SystemSettings\DetailView;
use App\Modules\SystemSettings\EditView;
use Illuminate\Support\Facades\Auth;

class SystemSettingController extends SoftdevController
{

    public $module_dir = 'SystemSetting'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}


    public $export_field = array(
    'name' => 'SystemSetting Name',
    );
    public function __construct()
    {
        $this->LogDebug('SystemSettingController initialized');

        $table_name = new SystemSetting();

        $this->table_name = $table_name->table;

        $this->middleware('auth:sanctum');

        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }
    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: SystemSettings.controller->index()');

        $product = new ListView();

        return $product->getDatas($request);
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: SystemSettings.controller->store()');

        $edit = new EditView();
        return $message = $edit->addData($request);
    }
    public function show(SystemSetting $systemsetting): JsonResponse
    {
        $this->LogInfo('Begin: SystemSettings.controller->show()');
        try
        {
            return response()->json(new SystemSettingResource($systemsetting));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: SystemSettings.controller->show()', ['record_id' => $systemsetting->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
    public function update(UpdateRequest $request, SystemSetting $systemsetting): JsonResponse
    {
        $this->LogInfo('Begin: SystemSettings.controller->update()');

        $detail = new DetailView();

        return $detail->updateData($request, $systemsetting);
    }
    public function export($request)
    {
        $this->LogInfo('Begin: SystemSettings.controller->export()');

        $user_list = new ListView();
        return $user_list->export($request);
    }
    public function getSystemSettingSettingValue()
    {
        $this->LogInfo('Begin: SystemSettings.controller->getSystemSettingSettingValue()');
        try
        {
            $branch_id = Auth::User()->branch_id;

            $result = SystemSetting::where('branch_id', $branch_id)->where('category','system')->get();

            return response()->json($result);
        }
        catch (\Throwable $e)
        {
            $this->LogCritical('Failed: SystemSettings.controller->getSystemSettingSettingValue()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
}
