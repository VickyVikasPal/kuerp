<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\PdfSettings\Requests\StoreRequest;
use App\Modules\PdfSettings\Requests\UpdateRequest;
use App\Modules\PdfSettings\Resources\PdfSettingResource;
use App\Models\PdfSetting;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\PdfSettings\ListView;
use App\Modules\PdfSettings\DetailView;
use App\Modules\PdfSettings\EditView;
use Illuminate\Support\Facades\Auth;

class PdfSettingController extends SoftdevController
{

    public $module_dir = 'PdfSetting'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}


    public $export_field = array(
    'name' => 'PdfSetting Name',
    'branch_code' => 'PdfSetting Code',
    );
    public function __construct()
    {
        $this->LogDebug('PdfSettingController initialized');

        $table_name = new PdfSetting();

        $this->table_name = $table_name->table;

        $this->middleware('auth:sanctum');

        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return JsonResponse
     * @throws JsonException
     */
    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: PdfSettings.controller->index()');

        $product = new ListView();

        return response()->json($product->getDatas($request));
    }
    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: PdfSettings.controller->store()');

        $edit = new EditView();

        return $edit->addData($request);
    }
    public function update(UpdateRequest $request, PdfSetting $pdfsettings): JsonResponse
    {
        $this->LogInfo('Begin: PdfSettings.controller->update()');

        $detail = new DetailView();

        return $detail->updateData($request, $pdfsettings);
    }
    public function show(PdfSetting $pdfsetting): JsonResponse
    {
        $this->LogInfo('Begin: PdfSettings.controller->show()');
        try
        {
            return response()->json(new PdfSettingResource($pdfsetting));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: PdfSettings.controller->show()', ['record_id' => $pdfsetting->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
    public function export($request)
    {
        $this->LogInfo('Begin: PdfSettings.controller->export()');

        $user_list = new ListView();
        return $user_list->export($request);
    }
    public function getPdfSettingSettingValue()
    {
        $this->LogInfo('Begin: PdfSettings.controller->getPdfSettingSettingValue()');

        try
        {
            $branch_id = Auth::User()->branch_id;
            $result = PdfSetting::where('branch_id', $branch_id)->where('category','pdf')
                ->get();
            return response()->json($result);
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: PdfSettings.controller->show()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
}
