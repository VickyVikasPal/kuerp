<?php
namespace App\Modules\Examples;

use App\Models\Example;
use App\Common\Base64ToImage;
use App\Common\Datetime\TimeDate;

class DetailView
{
    public function updateData($request, $example)
    {

        try
        {
            $example->LogDebug('Begin: Examples.DetailView->updateData()', ['params' => $request->all()]);

            $datetime = new TimeDate();

            $formData = $request->get('editFormData');

            $example->name = $formData['name'];

            $example->email = $formData['email'];

            $example->phone = $formData['phone'];

            $example->gender = $formData['gender'];

            $example->dob = $datetime->to_db_date(date('d/m/Y', strtotime($formData['dob'])));

            $example->qualification = $formData['qualification'];

            $example->hobbies = $formData['hobbies'];

            $example->parent_id = $formData['parent_id'];

            $example->parent_type = $formData['parent_type'];

            if ($example->save())
            {
                $example->LogDebug('End: Examples.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $example->id]);

                if ($request->get('fileUpload') == true)
                {
                    $id = $example->id;

                    $example = Example::find($id);

                    $imagepath = Base64ToImage::base64ToImage($request->get('fileContent'), $id . '.' . $request->get('fileExt'));

                    $example->image = $imagepath;

                    $example->save();
                }

                return response()->json(['message' => 'Record updated successfully'], 200);
            }
        }
        catch (\Throwable $e)
        {
            $example->LogCritical('Failed: Examples.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $example->id, 'error' => $e->getMessage()]);
            
            return response()->json(['message' => 'Failed to update record'], 500);
        }
    }
    public function getAuditDatas($id, $example)
    {
        try
        {
            $tablename = 'audits_' . $example->table;

            $where = array('auditable_id' => $id);

            $datas = $example->getAuditDatas($tablename, $where);

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
                
                $user_info = $example->getDbPropertyValue('users', array('id' => $resut->user_id), false, array('first_name', 'last_name'));
                
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
            $example->LogCritical('Failed: Examples.ListView->getDatas()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to retrieve items'], 500);
        }
    }
}