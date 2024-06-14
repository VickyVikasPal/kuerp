<?php

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Http\Requests\Dashboard\Admin\SubCategory\StoreRequest;
use App\Http\Requests\Dashboard\Admin\SubCategory\UpdateRequest;
use App\Http\Resources\SubCategory\SubCategoryResource;
use App\Models\SubCategory;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\SubCategorys\ListView;
use App\Modules\SubCategorys\DetailView;
use App\Modules\SubCategorys\EditView;

class SubCategoryController extends SoftdevController
{
    public $module_dir = 'SubCategorys'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = 'subcategorys';

    public $export_field = array(
        'name'  => 'Name',
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
        /* $edit = new EditView();
       $message = $edit->get_edit($request);
        
        if ($message['message'] =='success') {
            return response()->json(['message' => 'Data saved correctly', 'product' => new ProductResource($product)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500); */
        $edit = new EditView();
        return $message = $edit->getEdit($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function show(SubCategory $subcategory): JsonResponse
    {
        /** @var User $authUser */
        /* $authUser = Auth::user();
        if ($product->id === $authUser->id) {
            return response()->json(['message' => __('Can not edit your user from the user manager, go to your account page')], 406);
        } */
        return response()->json(new SubCategoryResource($subcategory));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, SubCategory $subcategory): JsonResponse
    {
       // $request->validated();
       $detail = new DetailView();
       $message = $detail->get_details($request, $subcategory);

       if ($message['message'] =='success') {
        return response()->json(['message' => 'Data updated correctly', 'subcategory' => new SubCategoryResource($subcategory)]);
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
    public function destroy(SubCategory $user): JsonResponse
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
        
        $product=SubCategory::find($request->get('delete_id'));
        $product->deleted = '1';
        $product->save();

        return response()->json(['message' => 'Data deleted successfully']);
    }

    public function getMenu(Request $request)
    {
        $subcategory = SubCategory::where('status','=','Active')->where('parent_id','=',$request->get('parent_id'))->get();
       //$result = new CategoryResource($category)
       
        return response()->json($subcategory);
    }

    public function subCategoryById(Request $request){
        $subcategory = new ListView();
        $category_id = $request->get('parent_id');
        $result = $subcategory->getSubCategoryById($category_id);
        return response()->json($result);
    }
}
