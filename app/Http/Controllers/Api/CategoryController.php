<?php

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\Categorys\Requests\StoreRequest;
use App\Modules\Categorys\Requests\UpdateRequest;
use App\Modules\Categorys\Resources\CategoryResource;
use App\Models\Category;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Categorys\ListView;
use App\Modules\Categorys\DetailView;
use App\Modules\Categorys\EditView;

class CategoryController  extends SoftdevController
{
    public $module_dir = 'Categorys'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}


    public $export_field = array(
        'name' => 'Category Name',
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
    public function show(Category $category, $id): JsonResponse
    {
       
        return response()->json(new CategoryResource(Category::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Category $category): JsonResponse
    {
       // $request->validated();
       $detail = new DetailView();
       $message = $detail->get_details($request, $category);

       if ($message['message'] =='success') {
        return response()->json(['message' => 'Data updated correctly', 'category' => new CategoryResource($category)]);
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
    public function destroy(Category $user): JsonResponse
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
        
        $product=Category::find($request->get('delete_id'));
        $product->deleted = '1';
        $product->save();

        return response()->json(['message' => 'Data deleted successfully']);
    }

    public function getMenu(Request $request)
    {
        $category = Category::where('status','=','Active')->where('deleted','=','0')->get();
       //$result = new CategoryResource($category)
       
        return response()->json($category);
    }
}
