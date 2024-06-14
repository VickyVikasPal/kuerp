<?php
namespace App\Http\Controllers\Api;

use App\Common\SoftdevController;
use App\Modules\Emails\Requests\StoreRequest;
use App\Modules\Emails\Requests\UpdateRequest;
use App\Modules\Emails\Resources\EmailResource;
use App\Models\Email;

use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Modules\Emails\ListView;
use App\Modules\Emails\DetailView;
use App\Modules\Emails\EditView;

class EmailController extends SoftdevController
{

    public $module_dir = 'Emails'; // it should be same as app->Modules->{YourModuleName}
    public $table_name = ''; // it should be same as app->Modules->{YourModuleName}
    public $export_field = array(
    'name' => 'Email Name',
    'email_code' => 'Email Code',
    );
    public function __construct()
    {
        $this->LogDebug('EmailController initialized');

        $table_name = new Email();

        $this->table_name = $table_name->table;

        $this->middleware('auth:sanctum');

        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
    }
    public function index(Request $request): JsonResponse
    {
        $this->LogInfo('Begin: Emails.controller->index()');

        $product = new ListView();

        return $product->getDatas($request);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $this->LogInfo('Begin: Emails.controller->store()');

        $edit = new EditView();
        
        return $edit->addData($request);
    }
    public function show(Email $email): JsonResponse
    {
        $this->LogInfo('Begin: Emails.controller->show()');
        try
        {
            return response()->json(new EmailResource($email));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: Emails.controller->show()', ['record_id' => $email->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }

    public function update(UpdateRequest $request, Email $email): JsonResponse
    {
        $this->LogInfo('Begin: Emails.controller->update()');

        $detail = new DetailView();

        return $detail->updateData($request, $email);
    }

    /*  public function remove(Request $request)
     {
     $product=Email::find($request->get('delete_id'));
     $product->deleted = '1';
     $product->save();
     return response()->json(['message' => 'Data deleted successfully']);
     } */

    /* public function getMenu(Request $request)
     {
     $email = Email::where('status','=','Active')->where('parent_id','=',$request->get('parent_id'))->get();
     
     return response()->json($email);
     } */
    public function export($request)
    {
        $this->LogInfo('Begin: Emails.controller->export()');

        $user_list = new ListView();

        return $user_list->export($request);
    } /* 
  public function getActiveEmail(Request $request)
  {
  $email = new ListView();
  $result = $email->getActiveEmail();
  return response()->json($result);
  } */
    public function getEmailSettingValue()
    {
        $this->LogInfo('Begin: Emails.controller->getEmailSettingValue()');
        
        $email = new Email();
        
        $result = $email->getDbPropertyValue($email->table, array('deleted' => 0));

        $this->LogInfo('End: Emails.controller->getEmailSettingValue()');

        return response()->json($result);
    }
}
