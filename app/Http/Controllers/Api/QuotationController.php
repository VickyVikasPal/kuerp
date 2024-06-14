<?php

namespace App\Http\Controllers\Api;


use App\Common\SoftdevController;
use App\Common\SoftdevMail as Mail;
use App\Modules\Quotations\Requests\StoreRequest;
use App\Modules\Quotations\Requests\UpdateRequest;
use App\Modules\Quotations\Resources\QuotationResource; 
use App\Models\Quotation;
/* use App\Models\UserRole; */
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Quotations\ListView;
use App\Modules\Quotations\DetailView;
use App\Modules\Quotations\EditView;
use App\Modules\Quotations\Pdf\HealQuotationLabel;


class QuotationController extends SoftdevController
{
    public $module_dir = 'Quotations'; // it should be same as app->Modules->{YourModuleName}

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
    public function show(Quotation $product, $id): JsonResponse
    {
        return response()->json(new QuotationResource(Quotation::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Purchase $product): JsonResponse
    {
       // $request->validated();
       $detail = new DetailView();
       $message = $detail->get_details($request, $product);

       if ($message['message'] =='success') {
        return response()->json(['message' => 'Data updated correctly', 'product' => new PurchaseResource($product)]);
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
        $result =  PurchaseResource::collection($data);
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

    public function saveQuotation(Request $request)
    {
        $purchase = new EditView();

        return $purchase->saveQuotation($request);
    }

    public function removeItem(Request $request)
    {
        $edit = new EditView();

        return $edit->removeItem($request);
    }

    public function updateQuotation(Request $request)
    {
        $edit = new EditView();

        return $edit->updateQuotation($request);
    }

    public function getCustomerById(Request $request)
    {
        $purchase = new ListView();

       return $purchase->getCustomerById($request);
    }

   /* public function addItems(Request $request)
    {
       $edit = new EditView();

       return $edit->addItems($request);
    } */

    public function createDelivery(Request $request)
    {
        $edit = new EditView();
        return $edit->createDelivery($request);
    }

    public function getQuotationPDF(Request $request)
    {
        $list = new ListView();

        return $list->getQuotationPDF($request);
    }

}
