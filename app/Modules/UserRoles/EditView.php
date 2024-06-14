<?php
namespace App\Modules\UserRoles;

use App\Models\UserRole;
use App\Models\UserRoleAction;
use App\Modules\UserRoles\Resources\UserRoleEditResource;
use Auth;
use Illuminate\Support\Facades\Session;
use App\Common\Datetime\TimeDate;

class EditView
{
    public function addData($request)
    {
        $userRole = new UserRole();

        /*try
        {*/
            $userRole->LogDebug('Begin: UserRoles.EditView->addData()', ['params' => $request->all()]);

            $request->validated();

            $userRole = new UserRole();

            $userRole->name = $request->get('name') ?? '';

            $userRole->status = $request->get('status')??'';

            if ($userRole->save())
            {
                if (!empty($request->get('module_data')))
                {

                    foreach ($request->get('module_data') as $key => $value)
                    {
                        $userroleaction = new UserRoleAction();

                        $userroleaction->name = $value['module'] ?? null;

                        $userroleaction->access = $value['access'] ?? null;

                        $userroleaction->delete = $value['delete'] ?? null;

                        $userroleaction->export = $value['export'] ?? null;

                        $userroleaction->list = $value['list'] ?? null;

                        $userroleaction->edit = $value['edit'] ?? null;

                        $userroleaction->view = $value['view'] ?? null;

                        $userroleaction->parent_type = 'UserRoles';

                        $userroleaction->parent_id = $userRole->id;

                        $userroleaction->save();
                    }
                }
                $userRole->LogInfo('End: UserRoles.EditView->addData()', ['user_id' => $request->user()->id, 'record_id' => $userRole->id]);

                return response()->json(['message' => 'Data saved correctly', 'userRole' => new UserRoleEditResource($userRole)]);
            }
        /*}
        catch (\Throwable $e)
        {
            $userRole->LogCritical('Failed: UserRoles.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e]);

            return response()->json(['message' => 'Failed to create Record'], 500);
        }*/

    }
}
