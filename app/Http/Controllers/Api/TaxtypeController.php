<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Taxtype\StoreRequest;
use App\Http\Requests\Dashboard\Admin\Taxtype\UpdateRequest;
use App\Http\Resources\Taxtype\TaxtypeResource;
use App\Models\Taxtype;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Taxtypes\ListView;
use App\Modules\Taxtypes\DetailView;
use App\Modules\Taxtypes\EditView;

class TaxtypeController extends Controller
{
    public function __construct()
    {
        $this->LogDebug('TaxtypeController initialized');

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
        $this->LogInfo('Begin: Taxtypes.controller->index()');

        $taxtype = new ListView();

        return response()->json($taxtype->get_list($request));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: Taxtypes.controller->store()');

        $edit = new EditView();
        return $message = $edit->getEdit($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function show(Taxtype $taxtype): JsonResponse
    {
        $this->LogInfo('Begin: Taxtypes.controller->show()');
        try
        {
            return response()->json(new TaxtypeResource($taxtype));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: Taxtypes.controller->show()', ['record_id' => $taxtype->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Taxtype $taxtype): JsonResponse
    {
        $this->LogInfo('Begin: Taxtypes.controller->update()');
        // $request->validated();
        $detail = new DetailView();
        $message = $detail->get_details($request, $taxtype);

        if ($message['message'] == 'success')
        {
            return response()->json(['message' => 'Data updated correctly', 'taxtype' => new TaxtypeResource($taxtype)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }
    public function gettax(Request $request)
    {
        $this->LogInfo('Begin: Taxtypes.controller->gettax()');

        $taxtype = Taxtype::where('status', '=', 'Active')->where('deleted', '=', '0')->get();
        //$result = new CategoryResource($category)

        return response()->json($taxtype);
    }
}
