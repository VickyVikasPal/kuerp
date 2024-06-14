<?php
namespace App\Modules\UserDashlets;

use App\Modules\UserDashlets\Resources\UserDashletResource;
use Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Models\UserDashlet;
use Route;
use Setting;
use Str;
use App\Common\Datetime\TimeDate;
use App\Common\Utils;
use DB;

class DetailView
{
    public function updateData($request, $dashlet)
    {
         try
        { 
            $dashlet->LogDebug('Begin: UserDashlets.DetailView->updateData()', ['params' => $request->all()]);

            $request->validated();
            $user = Auth::user();
            $datetime = new TimeDate();
            // echo $request->get('id');

            $dashletSetup = DB::table('userdashletsetups')->select('id', 'user_type')->where('user_type', $request->get('user_type'))->where('deleted', 0)->where('branch_id', $user->branch_id)->get();
            if (count($dashletSetup) > 0)
            {
                $setup_id = $dashletSetup[0]->id;
                DB::table('userdashletsetups')
                    ->where('id', $setup_id)
                    ->update(array(
                        'date_modified' => $datetime->get_gmt_db_datetime(),
                        'modified_user_id' => $user->id,
                        'assigned_user_id' => $user->id,
                        'user_type' => $request->get('user_type'),
                        'status' => 0,
                        'branch_id' => $user->branch_id,
                        'left_width' => $request->get('leftWidth'),
                        'right_width' => $request->get('rightWidth')
                    ));

            }
            else
            {
                $setup_id = Utils::create_guid();
                DB::table('userdashletsetups')->insert(array(
                'id' => $setup_id,
                'date_entered' => $datetime->get_gmt_db_datetime(),
                'date_modified' => $datetime->get_gmt_db_datetime(),
                'modified_user_id' => $user->id,
                'assigned_user_id' => $user->id,
                'user_type' => $request->get('user_type'),
                'status' => 0,
                'branch_id' => $user->branch_id,
                'left_width' => $request->get('leftWidth'),
                'right_width' => $request->get('rightWidth')
                ));
            }

            $dashlet = UserDashlet::find($request->get('record'));

            $dashlet->name = $request->get('module');
            $dashlet->user_type = $request->get('user_type');
            $dashlet->graph_view = $request->get('graph') ? 1 : 0;
            $dashlet->table_view = $request->get('table') ? 1 : 0;
            $dashlet->branch_id = $user->branch_id;
            $dashlet->dashlet_setup_id = $setup_id;
            $dashlet->graph_type = $request->get('graph_type');

            if ($dashlet->save())
            {

                $dashlet->LogDebug('End: UserDashlets.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $dashlet->id]);

                return response()->json(['message' => 'Record updated successfully'], 200);
            }
        }
        catch (\Throwable $e)
        {
            $dashlet->LogCritical('Failed: UserDashlets.DetailView->updateData()', ['user_id' => $request->user()->id, 'record_id' => $dashlet->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to update record'], 500);
        }
    //return response()->json(['message' => __('An error occurred while saving data')], 500);
    }
    public function showData($module)
    {
        $authUser = Auth::user();
        /*  if ($module->id === $authUser->id) {
         return response()->json(['message' => __('Can not edit your user from the user manager, go to your account page')], 406);
         } */
        return response()->json(new UserDashletResource($module));
    }
    public function deleteData($module)
    {
        if ($module->delete())
        {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }
}
