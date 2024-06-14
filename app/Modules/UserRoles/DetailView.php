<?php
namespace App\Modules\UserRoles;

use App\Models\UserRole;
use App\Models\UserRoleAction;
use App\Modules\UserRoles\Resources\UserRoleResource;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Common\Datetime\TimeDate;

class DetailView
{
    public function updateData($request, $userRole, $id)
    {
        try
        {
           $user = Auth::user();
            $userRole->LogDebug('Begin: UserRoles.DetailView->updateData()', ['params' => $request->all()]);

            $request->validated();
           
            $userRole = UserRole::findOrFail($id);
            $userRole->name = $request->get('name') ?? '';
            $userRole->status = $request->get('status') ?? '';
            
            if (!empty($request->get('module_data')))
            {

                foreach ($request->get('module_data') as $key => $value)
                {
                    $userroleaction = UserRoleAction::find($value['id']);

                    if (empty($userroleaction->id)) {
                        
                        $userroleaction = new UserRoleAction();
                    }

                    $userroleaction->name = $value['module'] ?? null;

                    $userroleaction->access = $value['access']?? null;

                    $userroleaction->delete = $value['delete']?? null;

                    $userroleaction->export = $value['export']?? null;

                    $userroleaction->list = $value['list']?? null;

                    $userroleaction->edit = $value['edit']?? null;

                    $userroleaction->view = $value['view']?? null;

                    $userroleaction->parent_type = 'UserRoles';

                    $userroleaction->parent_id = $userRole->id;

                    $userroleaction->save();
                }
            }

            if ($userRole->save())
            {
                $userRole->LogDebug('End: UserRoles.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $userRole->id]);

                return response()->json(['message' => 'Record updated successfully'], 200);
            }
        }
        catch (\Throwable $e)
        {
            $userRole->LogCritical('Failed: UserRoles.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $userRole->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to update record'], 500);
        }

    }

    public function getAuditDatas($id, $userRole)
    {
        try
        {
            $userRole->LogDebug('Begin: UserRoles.DetailView->getAuditDatas()');

            $tablename = 'audits_' . $userRole->table;

            $where = array('auditable_id' => $id);

            $datas = $userRole->getAuditDatas($tablename, $where);

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
                $user_info = $userRole->getDbPropertyValue('users', array('id' => $resut->user_id), false, array('first_name', 'last_name'));
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

            $userRole->LogDebug('End: Examples.DetailView->updateData()', ['parent_array' => $parent_array]);

            return $parent_array;
        }
        catch (\Throwable $e)
        {
            $userRole->LogCritical('Failed: UserRoles.DetailView->getAuditDatas()', ['error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to update record'], 500);
        }
    }
}
