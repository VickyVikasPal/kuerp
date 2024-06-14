<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\CountryLists\Requests\StoreRequest;
use App\Modules\CountryLists\Requests\UpdateRequest;
use App\Modules\CountryLists\Resources\CountryListResource;
use App\Models\CountryList;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\CountryLists\ListView;
use App\Modules\CountryLists\DetailView;
use App\Modules\CountryLists\EditView;
use App\Common\SoftdevLog;

class CountryListController extends SoftdevController
{
    public $module_dir = 'CountryLists'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = '';

    public $export_field = array(
    'name' => 'Name',
    'isd_code' => 'isd_code',
    'status' => 'status'
    );
    public function __construct()
    {
        $this->LogDebug('CountryListController initialized');

        $countrylist = new CountryList();

        $this->table_name = $countrylist->table;
    }
    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: CountryLists.controller->index()');

        $countrylist = new ListView();

        return $countrylist->getDatas($request);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: CountryLists.controller->store()');

        $edit = new EditView();

        return $edit->addData($request);
    }

    public function show(CountryList $countrylist): JsonResponse
    {
        $this->LogInfo('Begin: CountryLists.controller->show()');
        try
        {
           
            $this->LogDebug('End: CountryLists.controller->show()', ['record_id' => $countrylist->id]);
            return response()->json(new CountryListResource($countrylist));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: CountryLists.controller->show()', ['record_id' => $countrylist->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
    public function update(UpdateRequest $request, CountryList $countrylist): JsonResponse
    {
        $this->LogInfo('Begin: CountryLists.controller->update()');

        $detail = new DetailView();

        return $detail->updateData($request, $countrylist);
    }
    public function export($request)
    {
        $this->LogInfo('Begin: CountryLists.controller->export()');

        $countrylist = new ListView();

        return $countrylist->export($request);
    }
    public function getChangeLogs($id, CountryList $countrylist): JsonResponse
    {
        $this->LogInfo('Begin: CountryLists.controller->getChangeLogs()');

        $detailview = new DetailView();

        return $detailview->getAuditDatas($id, $countrylist);
    }
}
