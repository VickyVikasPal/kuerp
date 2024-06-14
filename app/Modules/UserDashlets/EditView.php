<?php
namespace App\Modules\UserDashlets;

use App\Models\UserDashlet;
use App\Modules\UserDashlets\Resources\UserDashletResource;
use Illuminate\Support\Facades\DB;
use App\Common\Utils;
use Auth;
use App\Common\Datetime\TimeDate;

class EditView
{
    public function addData($request)
    {
        $dashlet = new UserDashlet();
        try
        {
            $dashlet->LogDebug('Begin: UserDashlets.EditView->addData()', ['params' => $request->all()]);

            $user = Auth::user();

            $datetime = new TimeDate();

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

            $dashlet->name = $request->get('module');
            $dashlet->user_type = $request->get('user_type');
            $dashlet->graph_view = $request->get('graph');
            $dashlet->table_view = $request->get('table');
            $dashlet->graph_type = $request->get('graph_type');
            $dashlet->branch_id = $user->branch_id;
            $dashlet->dashlet_setup_id = $setup_id;

            if ($dashlet->save())
            {
                $dashlet->LogDebug('End: UserDashlets.EditView->addData()', ['user_id' => $request->user()->id, 'record_id' => $dashlet->id]);

                return response()->json(['message' => 'Data saved correctly', 'dashlet' => new UserDashletResource($dashlet)]);
            }
        }
        catch (\Throwable $e)
        {
            $dashlet->LogCritical('Failed: UserDashlets.EditView->addData()', ['user_id' => $request->user()->id, 'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to create Record'], 500);
        }

    }

    public function updateDashletSetup($request)
    {
        $dashlet = new UserDashlet();
        try
        {
            $user = Auth::user();
            $datetime = new TimeDate();
            $widgetArray = $request->all();

            if (count($widgetArray) > 0)
            {
                foreach ($widgetArray as $key => $value)
                {
                    if ($value == true)
                    {
                        $dashlet = UserDashlet::find($key);

                        if (isset($dashlet->id))
                        {
                            $dashletConfig = DB::table('userdashletconfigs')->select('id')->where('dashlet_id', $dashlet->id)->where('deleted', 0)->where('branch_id', $user->branch_id)->get();
                            if (count($dashletConfig) > 0)
                            {
                                DB::table('userdashletconfigs')->where('id', $dashletConfig[0]->id)->update([
                                    'name' => $dashlet->name,
                                    'date_modified' => $datetime->get_gmt_db_datetime(),
                                    'modified_user_id' => $user->id,
                                    'assigned_user_id' => $user->id,
                                    'dashletsetup_id' => $dashlet->dashlet_setup_id,
                                    'dashlet_id' => $dashlet->id,
                                    'user_type' => $dashlet->user_type,
                                    'dashlet_name' => $dashlet->name . "Dashlet",
                                    'dashlet_module' => $dashlet->name,
                                    'dashlet_title' => $dashlet->name,
                                    'display_rows' => 5,
                                    'myitems_only' => 1,
                                    'dashlet_count' => 1,
                                    'dashlet_detail' => $dashlet->name,
                                    'graph_type' => $dashlet->graph_type,
                                    'graph_view' => $dashlet->graph_view,
                                    'table_view' => $dashlet->table_view,
                                    'branch_id' => $user->branch_id
                                ]);
                            }
                            else
                            {
                                DB::table('userdashletconfigs')->insert([
                                    'id' => Utils::create_guid(),
                                    'name' => $dashlet->name,
                                    'date_entered' => $datetime->get_gmt_db_datetime(),
                                    'date_modified' => $datetime->get_gmt_db_datetime(),
                                    'modified_user_id' => $user->id,
                                    'assigned_user_id' => $user->id,
                                    'dashletsetup_id' => $dashlet->dashlet_setup_id,
                                    'dashlet_id' => $dashlet->id,
                                    'user_type' => $dashlet->user_type,
                                    'dashlet_name' => $dashlet->name . "Dashlet",
                                    'dashlet_module' => $dashlet->name,
                                    'dashlet_title' => $dashlet->name,
                                    'display_rows' => 5,
                                    'myitems_only' => 1,
                                    'dashlet_count' => 1,
                                    'dashlet_detail' => $dashlet->name,
                                    'graph_type' => $dashlet->graph_type,
                                    'graph_view' => $dashlet->graph_view,
                                    'table_view' => $dashlet->table_view,
                                    'branch_id' => $user->branch_id
                                ]);
                            }

                            $dashlet->show_dashlets = 1;
                            $dashlet->save();

                        }
                        else
                        {

                            DB::table('userdashletconfigs')->insert([
                                'id' => Utils::create_guid(),
                                'name' => $dashlet->name,
                                'date_entered' => $datetime->get_gmt_db_datetime(),
                                'date_modified' => $datetime->get_gmt_db_datetime(),
                                'modified_user_id' => $user->id,
                                'assigned_user_id' => $user->id,
                                'dashletsetup_id' => $dashlet->dashlet_setup_id,
                                'dashlet_id' => $dashlet->id,
                                'user_type' => $dashlet->user_type,
                                'dashlet_name' => $dashlet->name . "Dashlet",
                                'dashlet_module' => $dashlet->name,
                                'dashlet_title' => $dashlet->name,
                                'display_rows' => 5,
                                'myitems_only' => 1,
                                'dashlet_count' => 1,
                                'dashlet_detail' => $dashlet->name,
                                'graph_type' => $dashlet->graph_type,
                                'graph_view' => $dashlet->graph_view,
                                'table_view' => $dashlet->table_view,
                                'branch_id' => $user->branch_id,
                            ]);
                            $dashlet->show_dashlets = 1;
                            $dashlet->save();
                        }

                    }
                    if ($value == false)
                    {
                        $dashlet = UserDashlet::find($key);
                        $dashlet->show_dashlets = 0;
                        $dashlet->save();
                    }
                }
            }
            $dashlet->LogDebug('End: UserDashlets.EditView->updateDashletSetup()', ['user_id' => $request->user()->id]);

            return response()->json(['message' => 'Dashlet saved correctly']);
        }
        catch (\Throwable $e)
        {
            $dashlet->LogCritical('Failed: UserDashlets.EditView->updateDashletSetup()', ['user_id' => $request->user()->id,'error' => $e->getMessage()]);

            return response()->json(['message' => 'Failed to update record'], 500);
        }

    }
}
