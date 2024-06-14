<?php
namespace App\Modules\CountryLists;

use App\Models\CountryList;
use App\Common\Base64ToImage;
use App\Modules\CountryLists\Resources\CountryListResource;
use App\Common\Datetime\TimeDate;

class EditView
{
    public function addData($request)
    {
        $countrylist = new CountryList();
        try
        {
            $countrylist->LogDebug('Begin: CountryLists.EditView->addData()', ['params' => $request->all()]);

            $datetime = new TimeDate();

            $formData = $request->get('editFormData');

            $countrylist->name = $formData['name'] ?? '';
            $countrylist->isd_code = $formData['isd_code'] ?? '';
            $countrylist->status = $formData['status'] ?? '';
           
            if ($countrylist->save())
            {
                $countrylist->LogInfo('End: CountryLists.EditView->addData()', ['user_id' => $request->user()->id, 'record_id' => $countrylist->id]);
                return response()->json(['message' => 'Record created successfully', 'countrylist' => new CountryListResource($countrylist)]);
            }
        }
        catch (\Throwable $e)
        {
            $countrylist->LogCritical('Failed: CountryLists.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create Record'], 500);
        }

    }

}