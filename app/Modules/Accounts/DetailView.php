<?php
namespace App\Modules\Accounts;

use App\Models\Account;
use App\Models\User;
use App\Common\Base64ToImage;
use App\Modules\Accounts\Resources\AccountResource;
use App\Modules\Accounts\Requests\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class DetailView
{

    public function updateData(UpdateRequest $request, Account $account)
    {
        try
        {
            $account->LogDebug('Begin: Accounts.DetailView->updateData()', ['params' => $request->all()]);

            $user_id = Auth::User()->id;
            $account = Account::find($user_id);
            if ($request->get('fileUpload') == true)
            {
                $imagepath = Base64ToImage::base64ToImage($request->get('file_content'), $user_id . '.' . $request->get('fileExt'));
                $account->avatar = $imagepath;
            }
            $account->first_name = $request->get('first_name');
            $account->last_name = $request->get('last_name');
            if ($account->save())
            {
                $account->LogDebug('End: Accounts.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $account->id]);

                return response()->json(['message' => 'Record updated successfully'], 200);
            }
            else
            {
                return response()->json(['message' => 'Failed to update record'], 500);
            }
        }
        catch (\Throwable $e)
        {
            $account->LogCritical('Failed: Accounts.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $account->id, 'error' => $e->getMessage()]);
            
            return response()->json(['message' => 'Failed to update record'], 500);
        }
    }

    public function updatePassword($request, $account)
    {
        try
        {
            $account->LogDebug('Begin: Accounts.DetailView->updatePassword()', ['params' => $request->all()]);

            $user_id = Auth::User()->id;
            $account = Account::find($user_id);
            $account->password = bcrypt($request->get('password'));

            if ($account->save())
            {
                $account->LogDebug('End: Accounts.DetailView->updatePassword()', ['user_id' => $request->user()->id, 'record_id' => $account->id]);

                return response()->json(['message' => 'Password updated successfully'], 200);
            }
            else
            {
                return response()->json(['message' => 'Failed to update Password'], 500);
            }
        }
        catch (\Throwable $e)
        {
            $account->LogCritical('Failed: Accounts.DetailView->updatePassword()', ['user_id' => $request->user()->id, 'record_id' => $account->id, 'error' => $e->getMessage()]);
            
            return response()->json(['message' => 'Failed to update Password'], 500);
        }
    }

    public function getData($account)
    {
        $account = new Account();
        try
        {
            $user_id = Auth::User()->id;

            $account = Account::find($user_id);

            $account->LogDebug('End: Accounts.controller->getData()', ['record_id' => $user_id]);

            return response()->json(new AccountResource($account));
        }
        catch (\Throwable $e)
        {
            // Log a critical error message
            $account->LogCritical('Failed: Accounts.controller->getData()', ['record_id' => Auth::User()->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve record'], 500);
        }
    }
}