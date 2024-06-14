<?php
namespace App\Modules\Branchs;

use App\Models\Branch;
use App\Common\Base64ToImage;
use App\Modules\Branchs\Resources\BranchResource;
use App\Modules\Branchs\Requests\StoreRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use File;

class EditView
{

    public function addData(StoreRequest $request)
    {
        $branch = new Branch();
        try
        {
            $branch->LogDebug('Begin: Branchs.EditView->addData()', ['params' => $request->all()]);

            $formData = $request->get('editFormData');

            $branch->name =  $request->get('name') ??'';
            $branch->branch_code =  $request->get('branch_code') ??'';
            $branch->upload_path =  $request->get('upload_path') ??'';
            $branch->description =  $request->get('description') ??'';
            $branch->ip_address =  $request->get('ip_address') ??'';
            $branch->status =  $request->get('status') ??'';
            $branch->default_branch =  $request->get('default_branch') ??'';
            $branch->for_mobileapp =  $request->get('for_mobileapp') ??'';
            $branch->upload_path =  $request->get('upload_path') ??'';

            if ($branch->save())
            {
                return response()->json(['message' => 'Data saved correctly', 'branch' => new BranchResource($branch)]);
            }
            $branch->LogInfo('End: Branchs.EditView->addData()', ['user_id' => $request->user()->id, 'record_id' => $branch->id]);
            return response()->json(['message' => __('An error occurred while saving data')], 500);
        }
        catch (\Throwable $e)
        {
            $branch->LogCritical('Failed: Branchs.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create Record'], 500);
        }


    }

}