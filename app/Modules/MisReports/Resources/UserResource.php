<?php
namespace App\Modules\Users\Resources;

use App\Models\User;
use App\Modules\UserRoles\Resources\UserRoleResource;
use App\Modules\Branchs\Resources\BranchResource;
use Illuminate\Http\Request;
use App\Models\UserPreference;
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
        $data = $this->getDbPropertyValue('user_preferences',array('assigned_user_id'=>$user->id));
        $user_pref_data = !empty($data->contents)?unserialize(base64_decode($data->contents)):'';
      //  print_r($user_pref_data);die;
        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'sex' => $user->sex,
            'user_name' => $user->user_name,
            'email_client' => $user->email_client,
            'email_primary' => $user->email_primary,
            'email_reply_to' => $user->email_reply_to,
            'email' => $user->email,
            'phone_mobile' => $user->phone_mobile,
            'login_status' => $user->login_status == '1' ? 'Active' : 'InActive',
            'branch_name' => (new BranchResource($user->branch))->name??'',
            'branch_id' => $user->branch_id,
            'time_format' => $user->time_format,
            'time_zone' => $user->time_zone,
            'user_role_name' => (new UserRoleResource($user->userRole))->name??'',
            'role_id' => $user->role_id,
            'qualification' => $user->qualification,
            'specialization' => $user->specialization,
            'address_street' => $user->address_street,
            'address_city' => $user->address_city,
            'address_state' => $user->address_state,
            'address_country' => $user->address_country,
            'address_postalcode' => $user->address_postalcode,
            'user_type' => $user->user_type,
            'status' => $user->status == '1' ? 'Active' : 'Inactive',
            'date_entered' => $user->date_entered ? date('d-m-Y', strtotime($user->date_entered)) : '',
            'updated_at' => $user->date_modified ? date('d-m-Y', strtotime($user->date_modified)) : '',
            'use_real_names' => $user_pref_data['use_real_names']??'',
            'dateformat' => $user_pref_data['dateformat']??'',
            'is_admin' => $user_pref_data['is_admin']??'',
            'timeformat' => $user_pref_data['timeformat']??'',
            'timezone' => $user_pref_data['timezone']??'',
            'ut' => $user_pref_data['ut']??'',
            'currency' => $user_pref_data['currency']??'',
            'default_currency_significant_digits' => $user_pref_data['default_currency_significant_digits']??'',
            'dec_sep' => $user_pref_data['dec_sep']??'',
            'num_grp_sep' => $user_pref_data['num_grp_sep']??'',
            'default_locale_name_format' => $user_pref_data['default_locale_name_format']??'',
        ];
    }
}
