<?php
namespace App\Modules\Users\Resources;

use App\Models\LoggedUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Users\Resources\UserResource;
use JsonException;
use App\Common\Datetime\TimeDate;

class LoggedResource extends JsonResource
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
        /** @var LoggedUser $user */
        $logged_user = $this;
        //echo "<pre>";print_r((new UserRoleResource($user->userRole)));die;
        $datetime = new TimeDate();
        return [
            'id'               => $logged_user->id,
            'user_id'          => $logged_user->user_id,
            'logged_in'        => $logged_user->logged_in,
            'last_login'       => $datetime->to_display_date_time($logged_user->last_login),
            'session_id'       => $logged_user->session_id,
            'remote_address'   => $logged_user->remote_address,
            'mod_timestamp'    => $logged_user->mod_timestamp,
            'branch_id'        => $logged_user->branch_id,
            'user_name'        => (new UserResource($logged_user->user))->name,
        ];
    }
}

