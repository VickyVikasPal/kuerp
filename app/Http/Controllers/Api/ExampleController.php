<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\Examples\Requests\StoreRequest;
use App\Modules\Examples\Requests\UpdateRequest;
use App\Modules\Examples\Resources\ExampleResource;
use App\Models\Example;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Examples\ListView;
use App\Modules\Examples\DetailView;
use App\Modules\Examples\EditView;
use App\Common\SoftdevLog;

class ExampleController extends SoftdevController
{
    public $module_dir = 'Example'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = '';

    public $export_field = array(

    'name' => 'Name',

    'email' => 'Email',

    'phone' => 'Phone',

    'gender' => 'Gender',

    'dob' => 'DOB'

    );

    public function __construct()
    {
        $this->LogDebug('ExampleController initialized');

        $example = new Example();

        $this->table_name = $example->table;
    }

    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: Examples.controller->index()');

        $product = new ListView();

        return $product->getDatas($request);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: Examples.controller->store()');

        $edit = new EditView();

        return $edit->addData($request);
    }

    public function show(Example $example): JsonResponse
    {
        $this->LogInfo('Begin: Examples.controller->show()');
        try
        {
            $this->LogDebug('End: Examples.controller->show()', ['record_id' => $example->id]);

            return response()->json(new ExampleResource($example));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: Examples.controller->show()', ['record_id' => $example->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }

    public function update(UpdateRequest $request, Example $Example): JsonResponse
    {
        $this->LogInfo('Begin: Examples.controller->update()');

        $detail = new DetailView();

        return $detail->updateData($request, $Example);
    }

    public function export($request)
    {
        $this->LogInfo('Begin: Examples.controller->export()');

        $example_list = new ListView();

        return $example_list->export($request);
    }

    public function getChangeLogs($id, Example $example): JsonResponse
    {
        $this->LogInfo('Begin: Examples.controller->getChangeLogs()');

        $detailview = new DetailView();

        return $detailview->getAuditDatas($id, $example);
    }
}
