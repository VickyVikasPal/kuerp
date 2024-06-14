<?php
namespace App\Modules\Users;

use App\Modules\Users\Resources\UserResource;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;

use App\Models\UserPreference;
use App\Models\User;

use Route;
use Setting;
use Str;

class DetailView
{
    public function updateData($request, $user)
    {
        $request->validated();
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->name = $request->get('first_name').' '.$request->get('last_name');
        $user->status = $request->get('status');
        $user->login_status = $request->get('login_status');
        $user->user_type = $request->get('user_type');
        $user->user_name = $request->get('user_name');
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
        $userprefdata['dec_sep'] =$request->get('dec_sep');
        $userprefdata['default_locale_name_format'] =$request->get('default_locale_name_format');
        if ($user->save()) {
            $data = $userpreference->getDbPropertyValue($userpreference->table,array('assigned_user_id' => $user->id));
            $userpreference = UserPreference::find($data->id);
            $userpreference->category   = 'Users';
            //$userpreference->branch_id  = $request->get('brnach_id');
            $userpreference->branch_id  = 111;
            $userpreference->contents =  base64_encode(serialize($userprefdata));
            $userpreference->save();
            return response()->json(['message' => 'Data updated correctly', 'user' => new UserResource($user)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }
    public function showData($module)
    {
        return response()->json(new UserResource($module));
    }
    public function deleteData($module)
    {
        if ($module->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }
}
