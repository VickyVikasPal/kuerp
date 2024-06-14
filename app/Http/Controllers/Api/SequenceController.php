<?php
/*********************************************************************************
 * This program is developed by Softdev Infotech Pvt. Ltd. * Copyright Softdev Infotech Pvt. Ltd. 2010 *********************************************************************************/

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Models\Sequence;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Sequences\Requests\StoreRequest;
use App\Modules\Sequences\Requests\UpdateRequest;
use App\Modules\Sequences\Resources\SequenceResource;
use App\Modules\Sequences\ListView;
use App\Modules\Sequences\DetailView;
use App\Modules\Sequences\EditView;

class SequenceController extends SoftdevController
{
    public function __construct()
    {
        $this->LogDebug('SequenceController initialized');

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
        $this->LogInfo('Begin: Sequences.controller->index()');

        $sequence = new ListView();

        return response()->json($sequence->getDatas($request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: Sequences.controller->store()');

        $edit = new EditView();
        return $edit->addData($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function show(Sequence $sequence): JsonResponse
    {
        $this->LogInfo('Begin: Sequences.controller->show()');
        try
        {
            return response()->json(new SequenceResource($sequence));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: Sequences.controller->show()', ['record_id' => $sequence->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }

    public function getData(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: Sequences.controller->getData()');

        $sequence = new Sequence();
        return response()->json(new SequenceResource($sequence->find($request->get('record'))));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Sequence $sequence): JsonResponse
    {
        $this->LogInfo('Begin: Sequences.controller->update()');

        // $request->validated();
        $detail = new DetailView();
        $message = $detail->updateData($request, $sequence);

        if ($message['message'] == 'success')
        {
            return response()->json(['message' => 'Data updated correctly', 'Sequence' => new SequenceResource($sequence)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }
/* 
    public function remove(Request $request)
    {
        $product = Sequence::find($request->get('delete_id'));
        $product->deleted = '1';
        $product->save();

        return response()->json(['message' => 'Data deleted successfully']);
    }*/
} 


?>