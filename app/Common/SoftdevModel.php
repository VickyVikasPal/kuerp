<?php
namespace App\Common;

use App\Models\UserRole;
use Eloquent;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Common\SoftdevController;
use App\Common\SoftdevAudit;
use App\Common\SoftdevMail as Mail;
use Storage;
use TenLog;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Modules\Users\Resources\UserResource;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Request;
use App\Common\Datetime\TimeDate;
use App\Models\SystemSetting;
//use Illuminate\Http\Request;

class SoftdevModel extends SoftdevAudit
{
    use TenLog;

    protected $perPage = 5;
    public function getPerPage()
    {
        $request = request();

        $callingFrom = $request->get('callingFrom','listView');
        
        if($callingFrom=='dashlet'){
            $perPage = $this->getSystemSettings('dashlet_max_entries_per_page') ?? 10;
        }else{
            $perPage = $this->getSystemSettings('list_max_entries_per_page') ?? 10;
        }
        if(!is_numeric($perPage) && $perPage < 0){
            $perPage =10;
        }
        return $this->perPage = $perPage;
    }

    public function scopeWithPermissions(Builder $query)
    {
        $current_user = Auth::user();

        $currentRoute = Route::current();

        if (empty($currentRoute))
        {
            return true;
        }
        $controllerAction = $currentRoute->getActionName();

        $controllerAction = class_basename($controllerAction);
        $controllerParts = explode('@', $controllerAction);
        $controllerName = $controllerParts[0];
        $module = explode('Controller', $controllerName)[0];
        $action = $controllerParts[1];

        $permissions = DB::table('user_roles_actions')
            ->where('parent_id', $current_user->role_id)
            ->where('deleted', '0')
            ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(substr($module, 0, -2)) . '%'])
            ->select('view', 'list', 'edit', 'access', 'id')
            ->first();

        $uinfo = (new UserResource($current_user))->toArray(null);

        $baseTable = $query->getModel()->getTable();

        $hasBranchIdColumn = Schema::hasColumn($baseTable, 'branch_id');

        $hasDeletedColumn = Schema::hasColumn($baseTable, 'deleted');

        if ($hasBranchIdColumn)
        {
            $query->where($baseTable . '.branch_id', '=', $current_user->branch_id);
        }

        if ($hasDeletedColumn)
        {
            $query->where($baseTable . '.deleted', '=', 0);
        }

        if ($uinfo['is_admin'] != '1')
        {
                if (!empty($permissions->id) && $uinfo['is_admin'] != '1')
                {
                    if ($action == 'show' && $permissions->view == 'Owner')
                    {
                        $query->where($baseTable . '.created_by', '=', $current_user->id);
                    }
                    else if (($action == 'index' || $action == 'list' || $action == 'count' || $action == 'getDataCount') && $permissions->list == 'Owner')
                    {
                        $query->where($baseTable . '.created_by', '=', $current_user->id);
                    }
                    else if ($action == 'update' && $permissions->edit == 'Owner')
                    {
                        $query->where($baseTable . '.created_by', '=', $current_user->id);
                    }
                }
        }

        return $query;
    }

    public static function deleteData($table_name, $id, $request = '')
    {
        $current_user = Auth::user();
        $route = $request->route();
        $action = $route->getAction();
        $controller = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controller);
        $module = explode('Controller', $controller)[0];

        $permissions = DB::table('user_roles_actions')
            ->where('parent_id', $current_user->role_id)
            ->where('deleted', '0')
            ->where('name', 'like', '%' . substr($module, 0, -2) . '%')
            ->select('delete')
            ->first();

        $deleteStatus = true;
        $data = 0;
        if (!empty($permissions->delete) && $permissions->delete == 'Owner')
        {
            $data = DB::update("UPDATE $table_name SET deleted = 1, date_modified = NOW() WHERE id = '$id' AND created_by = '" . $current_user->id . "'");
        }
        else
        {
            $data = DB::update("UPDATE $table_name SET deleted = 1, date_modified = NOW() WHERE id = '$id'");
        }
        if ($data < 1)
        {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'You don\'t have permission to access this action. Please contact your administrator.',
            ], 403);
        }
        else
        {
            return response()->json(['message' => 'Data deleted successfully']);
        }
    }

    public function getDbPropertyValue($table_name, $where = array(), $branch = true, $select = '*')
    {
        $this->LogInfo('Begin: app->common->SoftdevModel->getDbPropertyValue()');
        try
        {
            $exclude_branch = array('user_roles', 'user_preferences', 'branchs');

            if (in_array($table_name, $exclude_branch) || empty($branch))
            {
                $data = DB::table($table_name)->select($select)->where($where)->where('deleted', 0)->first();
            }
            else
            {
                $branch_id = Auth::User()->branch_id;

                $data = DB::table($table_name)->select($select)->where($where)->where('deleted', 0)->where('branch_id', $branch_id)->first();
            }

            $this->LogDebug('End: app->common->SoftdevModel->getDbPropertyValue()');

            return $data;
        }
        catch (\Throwable $e)
        {
            $this->LogCritical('Failed: app->common->SoftdevModel->getDbPropertyValue()', ['error' => $e->getMessage()]);

            return false;
        }
    }

    public function getDbPropertyList($table_name, $where = array(), $branch = true, $select = '*', $order_by = 'date_entered', $order_type = 'DESC')
    {
        $this->LogInfo('Begin: app->common->SoftdevModel->getDbPropertyValue()');
        try
        {
            $exclude_branch = array('user_roles', 'user_preferences', 'branchs');

            if (in_array($table_name, $exclude_branch) || empty($branch))
            {
                $data = DB::table($table_name)->select($select)->where($where)->where('deleted', 0)->orderBy($order_by, $order_type)->get();
            }
            else
            {
                $branch_id = Auth::User()->branch_id;

                $data = DB::table($table_name)->select($select)->where($where)->where('deleted', 0)->where('branch_id', $branch_id)->orderBy($order_by, $order_type)->get();
            }

            $this->LogDebug('End: app->common->SoftdevModel->getDbPropertyValue()');

            return $data;
        }
        catch (\Throwable $e)
        {
            $this->LogCritical('Failed: app->common->SoftdevModel->getDbPropertyValue()', ['error' => $e->getMessage()]);

            return false;
        }
    }
    public function sendMail($subject, $to, $cc = '', $bcc = '', $attachment = '', $html = '', $request_from = '', $module_name = '')
    {
        if ((new Mail)->sendMail($subject, $to, $cc, $bcc, $attachment, $html, '', $module_name))
        {
            return "mail sent successfully!";
        }
    }
    public function currencyFormat($price)
    {
        if (empty(Cache::get('localSettings')))
        {
            $local_settings = DB::table('config')->where('category', 'local')->get()->toArray();

            $local_settings = array_column($local_settings, 'value', 'name');

            Cache::forever('localSettings', $local_settings);

        }
        else
        {

            $local_settings = Cache::get('localSettings');
        }

        $defaultCurrencySymbol = $local_settings['default_currency_symbol'] ?? 'Rs';
        $defaultNumberGroupingSeparator = $local_settings['default_number_grouping_seperator'] ?? ',';
        $defaultDecimalSeparator = $local_settings['default_decimal_seperator'] ?? '.';

        // Apply formatting rules based on the details
        $formattedPrice = number_format($price, 2, $defaultDecimalSeparator, $defaultNumberGroupingSeparator);
        $formattedPrice = $defaultCurrencySymbol . ' ' . $formattedPrice;
        return $formattedPrice;
    }
    public function getSystemSettings($key)
    {
        $this->LogInfo('Begin: app.Common.SoftdevModel->getSystemSettings()');
        $current_user = Auth::user();
        try
        {

            if (empty(Cache::get('system_settings' . $current_user->id)))
            {
                $data = SystemSetting::where('branch_id', $current_user->branch_id)->where('category', 'system')->select('name', 'value')->get()->toArray();
                $result = [];
                foreach ($data as $item)
                {
                    $result[$item['name']] = $item['value'];
                }

                Cache::forever('system_settings' . $current_user->id, $result);
            }
            else
            {
                $result = Cache::get('system_settings' . $current_user->id);
            }

            $this->LogInfo('End: Begin: app.Common.SoftdevModel->getSystemSettings()');

            return $result[$key] ?? '';
        }
        catch (\Throwable $e)
        {
            $this->LogCritical('Failed: Begin: app.Common.SoftdevModel->getSystemSettings()', ['error' => $e]);

            return response()->json(['message' => 'Failed to get records'], 500);
        }
    }

    public function getRelationships($fromModule, $relationShipName, $column, $record, $options)
    {
        $returnData = array();
        if ($fromModule == 'WorkPackages')
        {

            $opInfo = DB::table('opportunity_workpackages')->where('workpackage_id', $record)->select('opportunity_id')->first();
            if(empty($opInfo)){
                return false;
            }
            $rtable = DB::table('relationships')->where('name', $relationShipName)->first();

            $returnData = DB::table($rtable->rhs_table)->where($rtable->rhs_key, $opInfo->opportunity_id)->select($options)->get();

        }
        else
        {

            $rtable = DB::table('relationships')->where('name', $relationShipName)->first();

            $returnData = DB::table($rtable->rhs_table)->where($rtable->rhs_key, $record)->select($options)->get();

        }
        return $returnData;

    }

}
