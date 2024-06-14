<?php
namespace App\Modules\Emails;

use App\Models\Email;
use App\Common\Base64ToImage;
use App\Modules\Emails\Resources\EmailResource;
use App\Modules\Emails\Requests\StoreRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use File;

class EditView
{

    public function addData(StoreRequest $request)
    {
        $email = new Email();
        try
        {
            $email->LogDebug('Begin: Emails.EditView->addData()', ['params' => $request->all()]);
           
            $request->validated();

            $email = new Email();

            $email->fromname = $request->get('fromname');

            $email->fromaddress = $request->get('fromaddress');

            $email->smtpserver = $request->get('smtpserver');

            $email->smtpport = $request->get('smtpport');

            $email->smtpuser = $request->get('smtpuser');

            $email->smtppassword = $request->get('smtppassword');

            if ($email->save())
            {
                $email->LogInfo('End: Emails.EditView->addData()', ['user_id' => $request->user()->id]);

                return response()->json(['message' => 'Data saved correctly', 'email' => new EmailResource($email)]);
            }

            $email->LogCritical('Failed: Emails.EditView->addData()', 'An error occurred while saving data');

            return response()->json(['message' => __('An error occurred while saving data')], 500);
        }
        catch (\Throwable $e)
        {
            $email->LogCritical('Failed: Emails.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);
            
            return response()->json(['message' => 'Failed to create Record'], 500);
        }

    }

}