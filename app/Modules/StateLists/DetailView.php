<?php
namespace App\Modules\StateLists;

use App\Models\StateList;
use App\Common\Base64ToImage;
use App\Common\Datetime\TimeDate;

class DetailView
{
    public function updateData($request, $statelist)
    {

        try
        {
            $statelist->LogDebug('Begin: StateLists.DetailView->updateData()', ['params' => $request->all()]);

            $datetime = new TimeDate();

            $formData = $request->get('editFormData');

            $statelist->name = $formData['name'];
            $statelist->isd_code = $formData['isd_code'];
            $statelist->parent_type = $formData['parent_type'];
            $statelist->parent_id = $formData['parent_id'];
            $statelist->status = $formData['status'];
            
            if ($statelist->save())
            {
                
                return response()->json(['message' => 'Record updated successfully'], 200);
            }
        }
        catch (\Throwable $e)
        {
            $statelist->LogCritical('Failed: StateLists.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $statelist->id, 'error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to update record'], 500);
        }
    }
    public function getAuditDatas($id, $statelist)
    {
        try
        {
            $tablename = 'audits_' . $statelist->table;
            $where = array('auditable_id' => $id);
            $datas = $statelist->getAuditDatas($tablename, $where);
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
                $user_info = $statelist->getDbPropertyValue('users', array('id' => $resut->user_id), false, array('first_name', 'last_name'));
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
            $statelist->LogCritical('Failed: StateLists.ListView->getDatas()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve items'], 500);
        }
    }
}