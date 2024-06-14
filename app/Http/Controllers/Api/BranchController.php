<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\Branchs\Requests\StoreRequest;
use App\Modules\Branchs\Requests\UpdateRequest;
use App\Modules\Branchs\Resources\BranchResource;
use App\Models\Branch;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Branchs\ListView;
use App\Modules\Branchs\DetailView;
use App\Modules\Branchs\EditView;

class BranchController extends SoftdevController
{

    public $module_dir = 'Branchs'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}


    public $export_field = array(
    'name' => 'Branch Name',
    'branch_code' => 'Branch Code',
    );
    public function __construct()
    {
        $this->LogDebug('BranchController initialized');

        $table_name = new Branch();

        $this->table_name = $table_name->table;

        $this->middleware('auth:sanctum');

        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }

    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: Branchs.controller->index()');

        $product = new ListView();

        return $product->getDatas($request);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: Branchs.controller->store()');

        $edit = new EditView();

        return $edit->addData($request);
    }

    public function show(Branch $branch, $id): JsonResponse
    {
        $this->LogInfo('Begin: Branchs.controller->show()');

        try
        {
            return response()->json(new BranchResource(Branch::findOrFail($id)));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: Branchs.controller->show()', ['record_id' => $branch->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }

    public function update(UpdateRequest $request, Branch $branch): JsonResponse
    {
        $this->LogInfo('Begin: Branchs.controller->update()');

        $detail = new DetailView();

        return $detail->updateData($request, $branch);
    }

    /* public function remove(Request $request)
     {
     $product = Branch::find($request->get('delete_id'));
     $product->deleted = '1';
     $product->save();
     return response()-$this->LogInfo('Begin: PdfSettings.controller->getPdfSettingSettingValue()');where('status', '=', 'Active')->where('parent_id', '=', $request->get('parent_id'))->get();
     return response()->json($branch);
     }
     public function branchById(Request $request)
     {
     $branch = new ListView();
     $category_id = $request->get('parent_id');
     $result = $branch->getBranchById($category_id);
     return response()->json($result);
     } */
    public function export($request)
    {
        $this->LogInfo('Begin: Branchs.controller->export()');

        $user_list = new ListView();

        return $user_list->export($request);
    }

  public function getActiveBranch(Request $request)
 {
 $branch = new ListView();
 $result = $branch->getActiveBranch();
 return response()->json($result);
 }
}
