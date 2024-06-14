<?php

namespace App\Http\Controllers\Api;


use App\Common\SoftdevController;
use App\Common\SoftdevMail as Mail;
use App\Modules\DeliveryChallans\Requests\StoreRequest;
use App\Modules\DeliveryChallans\Requests\UpdateRequest;
use App\Modules\DeliveryChallans\Resources\DeliveryChallanResource; 
use App\Models\DeliveryChallan;
/* use App\Models\UserRole; */
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\DeliveryChallans\ListView;
use App\Modules\DeliveryChallans\DetailView;
use App\Modules\DeliveryChallans\EditView;
use App\Models\DeliveryChallanItem;


class DeliveryChallanController extends SoftdevController
{
    public $module_dir = 'DeliveryChallans'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}


    public $export_field = array(
        'name' => 'Product Name',
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
       // (new Mail)->sendMail();
        $product = new ListView();
        $this->LogInfo("Hello World This is test Message of log");
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
       
        return $edit->addData($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function show(DeliveryChallan $product, $id): JsonResponse
    {
        return response()->json(new DeliveryChallanResource(DeliveryChallan::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, DeliveryChallan $deliverychallan): JsonResponse
    {
       // $request->validated();
       $detail = new DetailView();
       $message = $detail->updateDetails($request, $deliverychallan);

       if ($message['message'] =='success') {
        return response()->json(['message' => 'Data updated correctly', 'DeliveryChallan' => new DeliveryChallanResource($deliverychallan)]);
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
    public function destroy(Purchase $user): JsonResponse
    {
        /** @var User $authUser */
        $authUser = Auth::user();
        if ($user->id === $authUser->id) {
            return response()->json(['message' => __('You can not delete your own user')], 406);
        }
        if ($user->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }

    public function remove(Request $request)
    {
        
        $product=Purchase::find($request->get('delete_id'));
        $product->deleted = '1';
        $product->save();

        return response()->json(['message' => 'Data deleted successfully']);
    }

    public function getItem(Request $request): JsonResponse
    {
       if($request->get('catId') != ""){
           if($request->get('catId') == "All"){
            $data = Purchase::where('deleted','=','0')->get();
           }else{
            $data = Purchase::where('parent_id','=',$request->get('catId'))->where('deleted','=','0')->get();
           }
       }
       if($request->get('subcat_id') != ""){
        $data = Purchase::where('subcategory_id','=',$request->get('subcat_id'))->where('deleted','=','0')->get();
        }
        $result =  DeliveryChallanResource::collection($data);
        return response()->json($result);
    }

    public function addPurchase(StoreRequest $request)
    {
       $purchase = new EditView();
       return $purchase->addData($request);
    }

    public function getPurchase(Request $request): JsonResponse
    {
       $purchase = new ListView();

       return $purchase->getPurchase($request);
    }

    public function saveDelivery(Request $request)
    {
        $purchase = new EditView();

        return $purchase->saveDelivery($request);
    }

    public function removeItem(Request $request)
    {
        $edit = new EditView();

        return $edit->removeItem($request);
    }

    public function updateDelivery(UpdateRequest $request, DeliveryChallanItem $deliveryItem): JsonResponse
    {
        $detail = new DetailView();

        return $detail->updateDelivery($request, $deliveryItem);
    }

    public function getCustomerById(Request $request)
    {
        $purchase = new ListView();

       return $purchase->getCustomerById($request);
    }

    public function updateDeliveryData(UpdateRequest $request, DeliveryChallan $deliverychallan): JsonResponse
    {
       $detail = new DetailView();

       return $detail->updateDetails($request, $deliverychallan);
    }
    
    public function copyToInvoice(Request $request)
    {
        $edit = new EditView();
        return $edit->copeyToInvoice($request);
    }
}
