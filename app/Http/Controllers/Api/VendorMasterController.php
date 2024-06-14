<?php

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\VendorMasters\Requests\StoreRequest;
use App\Modules\VendorMasters\Requests\UpdateRequest;
use App\Modules\VendorMasters\Resources\VendorMasterResource;
use App\Models\VendorMaster;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\VendorMasters\ListView;
use App\Modules\VendorMasters\DetailView;
use App\Modules\VendorMasters\EditView;

class VendorMasterController  extends SoftdevController
{
    public $module_dir = 'VendorMasters'; // it should be same as app->Modules->{YourModuleName}

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
    public function show(VendorMaster $vendormaster, $id): JsonResponse
    {
       
        return response()->json(new VendorMasterResource(VendorMaster::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, VendorMaster $vendormaster): JsonResponse
    {
       // $request->validated();
       $detail = new DetailView();
       $message = $detail->get_details($request, $vendormaster);

       if ($message['message'] =='success') {
        return response()->json(['message' => 'Data updated correctly', 'vendormaster' => new VendorMasterResource($vendormaster)]);
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
    public function destroy(VendorMaster $vendormaster): JsonResponse
    {
        /** @var User $authUser */
        $authUser = Auth::user();
        if ($vendormaster->id === $authUser->id) {
            return response()->json(['message' => __('You can not delete your own user')], 406);
        }
        if ($vendormaster->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }

    public function userRoles(): JsonResponse
    {
        return response()->json(UserRoleResource::collection(UserRole::all()));
    }

    public function remove(Request $request)
    {
        
        $product=VendorMaster::find($request->get('delete_id'));
        $product->deleted = '1';
        $product->save();

        return response()->json(['message' => 'Data deleted successfully']);
    }

}
