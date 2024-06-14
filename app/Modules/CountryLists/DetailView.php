<?php
namespace App\Modules\CountryLists;

use App\Models\CountryList;
use App\Common\Base64ToImage;
use App\Common\Datetime\TimeDate;

class DetailView
{
    public function updateData($request, $countrylist)
    {

        try
        {
            $countrylist->LogDebug('Begin: CountryLists.DetailView->updateData()', ['params' => $request->all()]);

            $datetime = new TimeDate();

            $formData = $request->get('editFormData');

            $countrylist->name = $formData['name'];
            $countrylist->isd_code = $formData['isd_code'];
            $countrylist->status = $formData['status'];
            
            if ($countrylist->save())
            {
                
                return response()->json(['message' => 'Record updated successfully'], 200);
            }
        }
        catch (\Throwable $e)
        {
            $countrylist->LogCritical('Failed: CountryLists.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $countrylist->id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to update record'], 500);
        }
    }
    public function getAuditDatas($id, $countrylist)
    {
        try
        {
            $tablename = 'audits_' . $countrylist->table;
            $where = array('auditable_id' => $id);
            $datas = $countrylist->getAuditDatas($tablename, $where);
            $datetime = new TimeDate();

            $parent_array = array();
            foreach ($datas as $key => $resut)
            {
                $child_array = array();
                foreach (json_decode($resut->new_values) as $key => $val)
                {

                    $old_value = '';
                    if ($resut->old_values != '[]')
                    {
                        $old_value = json_decode($resut->old_values);
                        $old_value = $old_value->$key;
                    }

                    $child_array[] = array(
                        'field_name' => $key,
                        'old_value' => $old_value,
                        'new_value' => $val,
                    );
                }
                $user_info = $countrylist->getDbPropertyValue('users', array('id' => $resut->user_id), false, array('first_name', 'last_name'));
                if (!empty($user_info->first_name))
                {
                    $user_name = $user_info->first_name . ' ' . $user_info->last_name;
                }
                $parent_array[] = array(
                    'event' => $resut->event,
                    'changed_date' => $datetime->to_display_date_time($resut->created_at),
                    'changed_by' => $user_name ?? '',
                    'child_array' => $child_array,
                );
            }
            return response()->json($parent_array, 200);
        }
        catch (\Throwable $e)
        {
            $countrylist->LogCritical('Failed: CountryLists.ListView->getDatas()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve items'], 500);
        }
    }
}