<?php

namespace App\Http\Controllers\Api;


use App\Common\SoftdevController;
use App\Common\SoftdevMail as Mail;
use App\Modules\Products\Requests\StoreRequest;
use App\Modules\Products\Requests\UpdateRequest;
use App\Modules\Products\Resources\ProductResource;
/* use App\Http\Resources\UserRole\UserRoleResource; */
use App\Models\Product;
/* use App\Models\UserRole; */
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Products\ListView;
use App\Modules\Products\DetailView;
use App\Modules\Products\EditView;

class ProductController extends SoftdevController
{
    public $module_dir = 'Products'; // it should be same as app->Modules->{YourModuleName}

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
       
        return $edit->getEdit($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function show(Product $product, $id): JsonResponse
    {
        return response()->json(new ProductResource(Product::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Product $product): JsonResponse
    {
       // $request->validated();
       $detail = new DetailView();
       $message = $detail->get_details($request, $product);

       if ($message['message'] =='success') {
        return response()->json(['message' => 'Data updated correctly', 'product' => new ProductResource($product)]);
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
    public function destroy(Product $user): JsonResponse
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

    public function userRoles(): JsonResponse
    {
        return response()->json(UserRoleResource::collection(UserRole::all()));
    }

    public function remove(Request $request)
    {
        
        $product=Product::find($request->get('delete_id'));
        $product->deleted = '1';
        $product->save();

        return response()->json(['message' => 'Data deleted successfully']);
    }

    public function getItem(Request $request): JsonResponse
    {
       if($request->get('catId') != ""){
           if($request->get('catId') == "All"){
            $data = Product::where('deleted','=','0')->get();
           }else{
            $data = Product::where('parent_id','=',$request->get('catId'))->where('deleted','=','0')->get();
           }
       }
       if($request->get('subcat_id') != ""){
        $data = Product::where('subcategory_id','=',$request->get('subcat_id'))->where('deleted','=','0')->get();
        }
        $result =  ProductResource::collection($data);
        return response()->json($result);
    }

    public function bulkUploads(Request $request): JsonResponse
    {
        $edit = new EditView();
       
        return $edit->bulkUploads($request);
    }
    
    public function getProductById(Request $request): JsonResponse
    {
        $porduct = new ListView();
        return $porduct->getProductByid($request);        
    }
}
