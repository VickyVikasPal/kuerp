<?php
namespace App\Modules\Branchs;

use App\Models\Branch;
use App\Common\Base64ToImage;
use App\Modules\Branchs\Resources\BranchResource;
use App\Modules\Branchs\Requests\UpdateRequest;
use Illuminate\Http\JsonResponse;

class DetailView
{

    public function updateData($request, $branch)
    {
        try
        {
            $branch->LogDebug('Begin: Branchs.DetailView->updateData()', ['params' => $request->all()]);

            $formData = $request->get('editFormData');

            $branch = Branch::find($formData['id']);
            
            $branch->name = $formData['name'];
            $branch->branch_code = $formData['branch_code'];
            $branch->upload_path = $formData['upload_path'];
            $branch->description = $formData['description'];
            $branch->ip_address = $formData['ip_address'];
            $branch->status = $formData['status'];
            $branch->default_branch = $formData['default_branch'];
            $branch->for_mobileapp = $formData['for_mobileapp'];
            $branch->upload_path = $formData['upload_path'];

            if ($branch->save())
            {
                $branch->LogDebug('End: Branchs.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $branch->id]);

                return response()->json(['message' => 'Record updated successfully'], 200);
            }
        }
        catch (\Throwable $e)
        {
            $branch->LogCritical('Failed: Branchs.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' =>

            $branch->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to update record'], 500);
        }

    }
}