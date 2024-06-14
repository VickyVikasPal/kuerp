<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\Emails\Requests\StoreRequest;
use App\Modules\Emails\Requests\UpdateRequest;
use App\Modules\Emails\Resources\EmailStatusResource;
use App\Models\EmailStatus;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Emails\ListView;
use App\Modules\Emails\DetailView;

class EmailStatusController extends SoftdevController
{

    public $module_dir = 'EmailStatuss'; // it should be same as app->Modules->{YourModuleName}

    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}


    public $export_field = array(
    'name' => 'EmailStatus Name',
    'emailStatus_code' => 'EmailStatus Code',
    );
    public function __construct()
    {
        $this->LogDebug('EmailStatusController initialized');

        $table_name = new EmailStatus();

        $this->table_name = $table_name->table;

        $this->middleware('auth:sanctum');

        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }
    
    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: EmailStatuss.controller->index()');

        $product = new ListView();

        return $product->getDatas($request);
    }
    public function show(Request $request, $id): JsonResponse
    {
        $this->LogInfo('Begin: EmailStatuss.controller->show()');
        try
        {
            $emailStatus = EmailStatus::find($id);

            if (!$emailStatus)
            {
                return response()->json(['message' => 'Email status not found'], 404);
            }

            return response()->json(new EmailStatusResource($emailStatus));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: EmailStatuss.controller->show()', ['record_id' => $emailStatus->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
    public function export($request)
    {
        $this->LogInfo('Begin: EmailStatuss.controller->export()');

        $user_list = new ListView();
        return $user_list->export($request);
    }

}
