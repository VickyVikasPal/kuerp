<?php
namespace App\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Common\SoftdevModel;
use App\Common\SoftdevMail as Mail;
use TenLog;
use Config;
use Auth;
use Exception;

class SoftdevController extends Controller

{
    use TenLog;
    public $global_settings;
    /* 
     public function __construct()
     {
     
     }*/
    public function assignTable($table)
    {
        $this->table_name = $table;
    }


    public function deleteData(Request $request)
    {
        try
        {
            if ($this->table_name == 'users' && $request->get('delete_id') == 'aa646fb1-4abd-945a-f775-6452288b571a')
            {
                return response()->json(['status' => false, 'message' => 'supper admin can not be delete!']);
            }
            if ($this->table_name == 'user_roles' && $request->get('delete_id') == '1')
            {
                return response()->json(['status' => false, 'message' => 'supper admin role can not be delete!']);
            }

            if(!empty($request->get('mailType'))){
                if($request->get('mailType') == 'inbox'){
                    $this->table_name = 'inbound_email_text';
                }
                if($request->get('mailType') == 'outbox'){
                    $this->table_name = 'outbound_email_text';
                }
            }

            $this->LogInfo("End: app->common->SoftdevController->deleteData()");

            return SoftdevModel::deleteData($this->table_name, $request->get('delete_id'), $request);
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $this->LogCritical('Failed: app->common->SoftdevController->deleteData()', ['record_id' => $request->get('delete_id'), 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to delete record'], 500);
        }
    }
    
    public function sendMail($subject, $to, $html = '', $cc = '', $bcc = '', $attachment = '')
    {
        return (new Mail)->sendMail($subject, $to, $cc, $bcc, $attachment, $html);
    }

    public function synchronizedMail($request)
    {
        return (new Mail)->synchronizedMail($request);
    }
}
