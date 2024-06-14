<?php
namespace App\Modules\StateLists;

use App\Models\StateList;
use App\Common\Base64ToImage;
use App\Modules\StateLists\Resources\StateListResource;
use App\Common\Datetime\TimeDate;

class EditView
{
    public function addData($request)
    {
        $statelist = new StateList();
        try
        {
            $statelist->LogDebug('Begin: StateLists.EditView->addData()', ['params' => $request->all()]);

            $datetime = new TimeDate();

            $formData = $request->get('editFormData');

            $statelist->name = $formData['name'] ?? '';
            $statelist->parent_type = $formData['parent_type'] ?? '';
            $statelist->parent_id = $formData['parent_id'] ?? '';
            $statelist->status = $formData['status'] ?? '';
           
            if ($statelist->save())
            {
                $statelist->LogInfo('End: StateLists.EditView->addData()', ['user_id' => $request->user()->id, 'record_id' => $statelist->id]);
                return response()->json(['message' => 'Record created successfully', 'statelist' => new StateListResource($statelist)]);
            }
        }
        catch (\Throwable $e)
        {
            $statelist->LogCritical('Failed: StateLists.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create Record'], 500);
        }

    }

}