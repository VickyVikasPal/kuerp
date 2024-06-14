<?php
namespace App\Modules\UserRoles\Resources;

use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
use App\Common\Datetime\TimeDate;
class UserRoleResource extends JsonResource
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
        /** @var UserRole $userRole */
        $datetime = new TimeDate();
        $userRole = $this;
        return [
            'id' => $userRole->id,
            'name' => $userRole->name,
            'type' => $userRole->type,
            'date_entered' => $userRole->date_entered ? $datetime->to_display_date_time($userRole->date_entered) : '',
            'date_modified' => $userRole->date_entered ? $datetime->to_display_date_time($userRole->date_modified) : '',
            'status' => $userRole->status,
            'users' => $userRole->users()->count(),
            'permissions' => $userRole->getPermissions() ?? '',
        ];
    }
}
