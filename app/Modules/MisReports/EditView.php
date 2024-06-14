<?php
namespace App\Modules\Users;

use App\Models\User;
use App\Models\UserPreference;
use App\Modules\Users\Resources\UserEditResource;

class EditView
{
    public function addData($request)
    {
        $request->validated();
        $user = new User();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->name = $request->get('first_name').' '.$request->get('last_name');
        $user->status = $request->get('status');
        $user->login_status = $request->get('login_status');
        $user->user_type = $request->get('user_type');
        $user->user_name = $request->get('user_name');
        $user->password = bcrypt($request->get('password'));
        $user->email_client = $request->get('email_client');
        $user->email = $request->get('email');
        $user->email_address = $request->get('email');
        //  $user->email_primary = $request->get('email_primary');
        //   $user->email_reply_to = $request->get('email_reply_to');
        $user->branch_id = $request->get('branch_id');
        $user->role_id = $request->get('role_id');
        $user->sex = $request->get('sex');
        $user->phone_mobile = $request->get('phone_mobile');
        $user->qualification = $request->get('qualification');
        $user->specialization = $request->get('specialization');
        $user->address_street = $request->get('address_street');
        $user->address_city = $request->get('address_city');
        $user->address_state = $request->get('address_state');
        $user->address_country = $request->get('address_country');
        $user->address_postalcode = $request->get('address_postalcode');

        $userpreference = new UserPreference();
        $userprefdata = array();
        $userprefdata['is_admin'] =$request->get('is_admin');
        $userprefdata['use_real_names'] = $request->get('use_real_names');
        $userprefdata['dateformat'] = $request->get('dateformat');
        $userprefdata['timeformat'] = $request->get('timeformat');
        $userprefdata['timezone'] = $request->get('timezone');
        $userprefdata['ut'] = $request->get('ut');
        $userprefdata['currency'] = $request->get('currency');
        $userprefdata['default_currency_significant_digits'] =$request->get('default_currency_significant_digits');
        $userprefdata['num_grp_sep'] =$request->get('num_grp_sep');
        $userprefdata['default_number_grouping_seperator'] =$request->get('default_number_grouping_seperator');
        $userprefdata['dec_sep'] =$request->get('dec_sep');
        $userprefdata['default_locale_name_format'] =$request->get('default_locale_name_format');
        $userpreference->category   = 'Users';
        $userpreference->branch_id  = $request->get('brnach_id');
        $userpreference->contents =  base64_encode(serialize($userprefdata));
        if ($user->save()) {    
            $userpreference->assigned_user_id  = $user->id;
            $userpreference->save();
            return response()->json(['message' => 'Data saved correctly', 'user' => new UserEditResource($user)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);

    }
}
