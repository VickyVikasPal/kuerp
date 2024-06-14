<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\LocalSettings\Requests\StoreRequest;
use App\Modules\LocalSettings\Requests\UpdateRequest;
use App\Modules\LocalSettings\Resources\LocalSettingResource;
use App\Models\LocalSetting;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\LocalSettings\ListView;
use App\Modules\LocalSettings\DetailView;
use App\Modules\LocalSettings\EditView;
use Illuminate\Support\Facades\Auth;

class LocalSettingController extends SoftdevController
{

    public $module_dir = 'LocalSetting'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}


    public $export_field = array(
    'name' => 'LocalSetting Name',
    'branch_code' => 'LocalSetting Code',
    );
    public function __construct()
    {
        $this->LogDebug('LocalSettingController initialized');

        $table_name = new LocalSetting();

        $this->table_name = $table_name->table;

        $this->middleware('auth:sanctum');

        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }

    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: LocalSettings.controller->index()');

        $product = new ListView();

        return $product->getDatas($request);
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: LocalSettings.controller->store()');

        $edit = new EditView();
        return  $edit->addData($request);
    }
    public function show(LocalSetting $localsetting): JsonResponse
    {
        $this->LogInfo('Begin: LocalSettings.controller->show()');
        try
        {
            return response()->json(new LocalSettingResource($localsetting));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: LocalSettings.controller->show()', ['record_id' => $localsetting->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }

    public function update(UpdateRequest $request, LocalSetting $localsetting): JsonResponse
    {
        $this->LogInfo('Begin: LocalSettings.controller->update()');

        $detail = new DetailView();

        return $detail->updateData($request, $localsetting);
    }

    public function export($request)
    {
        $this->LogInfo('Begin: LocalSettings.controller->export()');

        $user_list = new ListView();
        return $user_list->export($request);
    }
    public function getLocalSettingSettingValue()
    {
        $this->LogInfo('Begin: LocalSettings.controller->getLocalSettingSettingValue()');
        try
        {
            $branch_id = Auth::User()->branch_id;
            $result = LocalSetting::where('branch_id', $branch_id)->where('category','local')
                ->get();
            return response()->json($result);
        }
        catch (\Throwable $e)
        {
            $this->LogCritical('Failed: LocalSettings.controller->getLocalSettingSettingValue()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
}
