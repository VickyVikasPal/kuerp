<?php
namespace App\Modules\Users;

use App\Modules\Users\Resources\UserResource;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Common\Base64ToImage;

use App\Models\UserPreference;
use App\Models\User;

use Route;
use Setting;
use Str;
use App\Common\Datetime\TimeDate;

class DetailView
{
    public function updateData($request, $user)
    {

        $request->validated();
        $formData = $request->get('editFormData');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->name = $request->get('first_name') . ' ' . $request->get('last_name');
        $user->status = $request->get('status');
        $user->login_status = $request->get('login_status');
        $user->user_type = $request->get('user_type');
        $user->user_name = $request->get('user_name');
        $user->email_client = $request->get('email_client');
        $user->email = $request->get('email');
        $user->email_address = $request->get('email');
        if(!empty($request->get('password'))){
            $user->password = bcrypt($request->get('password'));
        }
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
        $user->address_postalcode = $request->file('image');
        ;

        $userpreference = new UserPreference();
        $userprefdata = array();
        $userprefdata['is_admin'] = $request->get('is_admin');
        $userprefdata['use_real_names'] = $request->get('use_real_names');
        $userprefdata['dateformat'] = $request->get('dateformat');
        $userprefdata['timeformat'] = $request->get('timeformat');
        $userprefdata['timezone'] = $request->get('timezone');
        $userprefdata['ut'] = $request->get('ut');
        $userprefdata['currency'] = $request->get('currency');
        $userprefdata['default_currency_significant_digits'] = $request->get('default_currency_significant_digits');
        $userprefdata['num_grp_sep'] = $request->get('num_grp_sep');
        $userprefdata['dec_sep'] = $request->get('dec_sep');
        $userprefdata['default_locale_name_format'] = $request->get('default_locale_name_format');
        if ($user->save()) {

            if ($request->get('fileUpload') == true) {
                $user_id = $user->id;
                $user = User::find($user_id);
                $imagepath = Base64ToImage::base64ToImage($request->get('file_content'), $user_id . '.' . $request->get('fileExt'));
                $user->avatar = $imagepath;
                $user->save();
            }

            $data = $userpreference->getDbPropertyValue($userpreference->table, array('assigned_user_id' => $user->id));
            if (!empty($data->id)) {
                $userpreference = UserPreference::find($data->id);
            }
            else {
                $userpreference->assigned_user_id = $user->id;
            }
            $userpreference->category = 'Users';
            $userpreference->branch_id = $request->get('branch_id');
            $userpreference->contents = base64_encode(serialize($userprefdata));
            $userpreference->save();
            return response()->json(['message' => 'Data updated correctly', 'user' => new UserResource($user)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);
    }

   
    public function deleteData($module)
    {
        if ($module->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }
    public function getAuditDatas($id, $user)
    {
        $tablename = 'audits_' . $user->table;
        $where = array('auditable_id' => $id);
        $datas = $user->getAuditDatas($tablename, $where);
        $datetime = new TimeDate();

        $parent_array = array();
        foreach ($datas as $key => $resut) {
            $child_array = array();
            foreach (json_decode($resut->new_values) as $key => $val) {

                $old_value = '';
                if ($resut->old_values != '[]') {
                    $old_value = json_decode($resut->old_values);
                    $old_value = $old_value->$key;
                }

                $child_array[] = array(
                    'field_name' => $key,
                    'old_value' => $old_value,
                    'new_value' => $val,
                );
            }
            $user_info = $user->getDbPropertyValue('users', array('id' => $resut->user_id), false, array('first_name', 'last_name'));
            if (!empty($user_info->first_name)) {
                $user_name = $user_info->first_name . ' ' . $user_info->last_name;
            }
            $parent_array[] = array(
                'event' => $resut->event,
                'changed_date' => $datetime->to_display_date_time($resut->created_at),
                'changed_by' => $user_name ?? '',
                'child_array' => $child_array,
            );
        }
        return $parent_array;
    }
}
