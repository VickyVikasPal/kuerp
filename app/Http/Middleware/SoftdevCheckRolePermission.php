<?php

namespace App\Http\Middleware;

use App\Models\User;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class SoftdevCheckRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = $request->route();
        $action = $route->getAction();
        $controller = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controller);
        $controller = explode('Controller', $controller)[0];
        if (!$this->checkAccess($action, $controller)) {
            abort(403, 'Unauthorized action! you dont have permission to access this page.please contact to your administrator.');
        }
        return $next($request);
    }
    public function checkAccess($action = 'access', $module = false)
    {
        $module = !empty($module) ? $module : $this->module_dir;

        $current_user = Auth::guard('sanctum')->user();
        if ($current_user->role_id == 1) {
            return true;
        }        //print_r($module);die;
        $action = strtolower($action);
        if (empty(Cache::get('aclModuleList'))) {
            $permissions = DB::table('user_roles')->where('id', $current_user->role_id)->first()->permissions;
            $aclModuleList = json_decode(json_decode((string)$permissions, true, 512, JSON_THROW_ON_ERROR));
            Cache::forever('aclModuleList', $aclModuleList);
        }else{
            $aclModuleList = Cache::get('aclModuleList');
        }
        if (empty($aclModuleList->accessAccess) || !in_array($module, $aclModuleList->accessAccess, true)) {
           // Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
            return false;
        }
        switch ($action) {
            case 'access':
                if (in_array($module, $aclModuleList->accessAccess, true)) {
                    return true;
                }
                else {
              //      Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'index':
                if (in_array($module, $aclModuleList->accessList, true)) {
                    return true;
                }
                else {
               //     Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'show':
                if (in_array($module, $aclModuleList->accessView, true)) {
                    return true;
                }
                else {
               //     Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'add':
            case 'store':
                if (in_array($module, $aclModuleList->accessAdd, true)) {
                    return true;
                }
                else {
               //     Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'update':
            case 'edit':
                if (in_array($module, $aclModuleList->accessEdit, true)) {
                    return true;
                }
                else {
               //     Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'destory':
            case 'remove':
            case 'delete':
                if (in_array($module, $aclModuleList->accessDelete, true)) {
                    return true;
                }
                else {
               //    Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'export':
                if (in_array($module, $aclModuleList->accessExport, true)) {
                    return true;
                }
                else {
                 //   Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
        }
        return true;
    }
}
