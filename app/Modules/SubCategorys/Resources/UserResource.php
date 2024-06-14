<?php
namespace App\Modules\Users\Resources;

use App\Models\User;
use  App\Modules\UserRoles\Resources\UserRoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;

class UserResource extends JsonResource
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
        /** @var User $user */
        $user = $this;
        //echo "<pre>";print_r((new UserRoleResource($user->userRole)));die;
        return [
            'id'                => $user->id,
            'salutation'        => $user->salutation,
            'first_name'        => $user->first_name,
            'last_name'         => $user->last_name,
            'username'          => $user->name,
            'email'             => $user->email,
            'phone'             => $user->phone,
            'designation_id'    => $user->designation_id,
            'department_id'     => $user->department_id,
            'branch_id'         => $user->branch_id,
            'time_format'       => $user->time_format,
            'time_zone'         => $user->time_zone,
            'role'              => (new UserRoleResource($user->userRole))->name,
            'user_role'         => (new UserRoleResource($user->userRole))->name,
            'role_id'           => $user->role_id,
            'status'            => $user->status=='1'?'Enabled':'Disabled',
            'created_at'        => $user->created_at->toISOString(),
            'updated_at'        => $user->updated_at->toISOString(),
        ];
    }
}
