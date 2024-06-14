<?php
namespace App\Modules\Emails;

use App\Models\Email;
use App\Common\Base64ToImage;
use App\Modules\Emails\Resources\EmailResource;
use App\Modules\Emails\Requests\UpdateRequest;

class DetailView
{

    public function updateData(UpdateRequest $request, $email)
    {
        try
        {
            $email->LogDebug('Begin: Emails.DetailView->updateData()', ['params' => $request->all()]);

            $request->validated();

            $email->fromname = $request->get('fromname');

            $email->fromaddress = $request->get('fromaddress');

            $email->smtpserver = $request->get('smtpserver');

            $email->smtpport = $request->get('smtpport');

            $email->smtpuser = $request->get('smtpuser');

            $email->smtppassword = $request->get('smtppassword');

            if ($email->save())
            {
                $email->LogDebug('End: Emails.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $email->id]);

                return response()->json(['message' => 'Record updated successfully'], 200);

            }
        }
        catch (\Throwable $e)
        {
            $email->LogCritical('Failed: Emails.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $email->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to update record'], 500);
        }

    }
}