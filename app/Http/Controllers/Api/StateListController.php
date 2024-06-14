<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\StateLists\Requests\StoreRequest;
use App\Modules\StateLists\Requests\UpdateRequest;
use App\Modules\StateLists\Resources\StateListResource;
use App\Models\StateList;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\StateLists\ListView;
use App\Modules\StateLists\DetailView;
use App\Modules\StateLists\EditView;
use App\Common\SoftdevLog;

class StateListController extends SoftdevController
{
    public $module_dir = 'StateLists'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = '';

    public $export_field = array(
    'name' => 'Name',
    'isd_code' => 'isd_code',
    'status' => 'status'
    );
    public function __construct()
    {
        $this->LogDebug('StateListController initialized');

        $statelist = new StateList();

        $this->table_name = $statelist->table;
    }
    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: StateLists.controller->index()');

        $statelist = new ListView();

        return $statelist->getDatas($request);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: StateLists.controller->store()');

        $edit = new EditView();

        return $edit->addData($request);
    }

    public function show(StateList $statelist): JsonResponse
    {
        $this->LogInfo('Begin: StateLists.controller->show()');
        try
        {
           
            $this->LogDebug('End: StateLists.controller->show()', ['record_id' => $statelist->id]);
            return response()->json(new StateListResource($statelist));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: StateLists.controller->show()', ['record_id' => $statelist->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
    public function update(UpdateRequest $request, StateList $statelist): JsonResponse
    {
        $this->LogInfo('Begin: StateLists.controller->update()');

        $detail = new DetailView();

        return $detail->updateData($request, $statelist);
    }
    public function export($request)
    {
        $this->LogInfo('Begin: StateLists.controller->export()');

        $statelist = new ListView();

        return $statelist->export($request);
    }
    public function getChangeLogs($id, StateList $statelist): JsonResponse
    {
        $this->LogInfo('Begin: StateLists.controller->getChangeLogs()');

        $detailview = new DetailView();

        return $detailview->getAuditDatas($id, $statelist);
    }
}
