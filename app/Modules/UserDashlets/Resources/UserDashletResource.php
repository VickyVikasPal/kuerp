<?php
namespace App\Modules\UserDashlets\Resources;

use App\Models\UserDashlet;
use App\Modules\UserDashlets\Resources\UserRoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
use App\Common\Datetime\TimeDate;
use DB;

class UserDashletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     * @throws JsonException
     */
    public function toArray($request)
    {
       
        /** @var UserDashlet $user */
        $user_dashlet = $this;
        $datetime = new TimeDate();
        $dashletSetup = DB::table('userdashletsetups')->join('userdashlets', 'userdashletsetups.id', '=', 'userdashlets.dashlet_setup_id')->where('userdashletsetups.user_type', $user_dashlet->user_type)->select('left_width', 'right_width')->get();
        $leftWidth = 0;
        $rightWidth = 0;
        foreach ($dashletSetup as $key => $value) {
           $leftWidth = $value->left_width;
           $rightWidth = $value->right_width;
        }
        //echo "<pre>";print_r((new UserRoleResource($user->userRole)));die;
        return [
            'id'                => $user_dashlet->id,
            'name'              => $user_dashlet->name,
            'user_type'         => $user_dashlet->user_type,
            'graph_view'        => $user_dashlet->graph_view =='1'?'Enabled':'Disabled',
            'table_view'        => $user_dashlet->table_view =='1'?'Enabled':'Disabled',
            'status'            => $user_dashlet->status =='Active'?'Active':'Inactive',
            'graph_type'         => $user_dashlet->graph_type,
            'status'         => $user_dashlet->status,
            'branch_id'         => $user_dashlet->branch_id,
            'leftWidth'         => $leftWidth,
            'rightWidth'         => $rightWidth,
            'date_entered'      => $datetime->to_display_date_time($user_dashlet->date_entered),
            'date_modified'     => $datetime->to_display_date_time($user_dashlet->date_modified),
           /*  'time_format'       => $user->time_format,
            'time_zone'         => $user->time_zone,
            'role'              => (new UserRoleResource($user->userRole))->name,
            'user_role'         => (new UserRoleResource($user->userRole))->name,
            'role_id'           => $user->role_id,
            'status'            => $user->status=='1'?'Enabled':'Disabled',
            'created_at'        => $user->created_at->toISOString(),
            'updated_at'        => $user->updated_at->toISOString(), */
        ];
    }
}
