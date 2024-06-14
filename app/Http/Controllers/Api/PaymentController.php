<?php

namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\Payments\Requests\StoreRequest;
use App\Modules\Payments\Requests\UpdateRequest;
use App\Modules\Payments\Resources\PaymentResource;
use App\Models\Payment;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Payments\ListView;
use App\Modules\Payments\DetailView;
use App\Modules\Payments\EditView;

class PaymentController  extends SoftdevController
{
    public $module_dir = 'Payments'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}


    public $export_field = array(
        'name' => 'Payment Name',
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
    public function show(Payment $payment, $id): JsonResponse
    {
       
        return response()->json(new PaymentResource(Payment::findOrFail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  User  $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Payment $payment): JsonResponse
    {
       // $request->validated();
       $detail = new DetailView();
       $message = $detail->get_details($request, $payment);

       if ($message['message'] =='success') {
        return response()->json(['message' => 'Data updated correctly', 'Payment' => new PaymentResource($payment)]);
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
    public function destroy(Payment $user): JsonResponse
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
        
        $product=Payment::find($request->get('delete_id'));
        $product->deleted = '1';
        $product->save();

        return response()->json(['message' => 'Data deleted successfully']);
    }

    public function updateInvoicePayment(Request $request): JsonResponse
    {
       $edit = new EditView();
       return $edit->updateInvoicePayment($request);
    }
}
