<?php

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\ClientMasters\Requests\StoreRequest;
use App\Modules\ClientMasters\Requests\UpdateRequest;
use App\Modules\ClientMasters\Resources\ClientMasterResource;
use App\Models\ClientMaster;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\ClientMasters\ListView;
use App\Modules\ClientMasters\DetailView;
use App\Modules\ClientMasters\EditView;

class ClientMasterController  extends SoftdevController
{
    public $module_dir = 'ClientMasters'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}


    public $export_field = array(
        'name' => 'Vendor Name',
    );
    
    public function __construct()
    {
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
        $product = new ListView();
        
       return response()->json($product->get_list($request));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $edit = new EditView();
        return $message = $edit->addData($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function show(ClientMaster $clientmaster, $id): JsonResponse
    {
       
        return response()->json(new ClientMasterResource(ClientMaster::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ClientMaster $clientmaster): JsonResponse
    {
       // $request->validated();
       $detail = new DetailView();
       $message = $detail->get_details($request, $clientmaster);

       if ($message['message'] =='success') {
        return response()->json(['message' => 'Data updated correctly', 'clientmaster' => new ClientMasterResource($clientmaster)]);
    }
    return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return JsonResponse
     * @throws Exception
     */
   
   

    public function remove(Request $request)
    {
        
        $product=ClientMaster::find($request->get('delete_id'));
        $product->deleted = '1';
        $product->save();

        return response()->json(['message' => 'Data deleted successfully']);
    }

}
