<?php
namespace App\Common;

use App\Models\UserRole;
use Eloquent;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * App\Models\UserRole
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property array|null $permissions
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserRole filter($input = [], $filter = null)
 * @method static Builder|UserRole newModelQuery()
 * @method static Builder|UserRole newQuery()
 * @method static Builder|UserRole paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|UserRole query()
 * @method static Builder|UserRole simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|UserRole whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|UserRole whereCreatedAt($value)
 * @method static Builder|UserRole whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|UserRole whereId($value)
 * @method static Builder|UserRole whereLike($column, $value, $boolean = 'and')
 * @method static Builder|UserRole whereName($value)
 * @method static Builder|UserRole wherePermissions($value)
 * @method static Builder|UserRole whereType($value)
 * @method static Builder|UserRole whereUpdatedAt($value)

 **/


class MyModel extends Model
{
    use HasFactory, Filterable;
    public function __construct()
    {
        // $this->checkAccess('access');
    }
    public function delete()
    {
        if ($this->checkAccess('delete')) {
            parent::delete();
        }
    }

    public function checkAccess($view = 'access')
    {
        $module = $this->module_dir;

        $current_user = Auth::user();

        if ($current_user->role_id == 1) {
            return true;
        }

        $view = strtolower($view);

        $permissions = DB::table('user_roles')->where('id', $current_user->role_id)->first()->permissions;

        $aclModuleList = json_decode(json_decode((string) $permissions, true, 512, JSON_THROW_ON_ERROR));
        if (!in_array($module, $aclModuleList->accessAccess, true)) {
            Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
            return false;
        }
        switch ($view) {
            case 'list':
                if (in_array($module, $aclModuleList->accessList, true)) {
                    return true;
                } else {
                    Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'view':
                if (in_array($module, $aclModuleList->accessView, true)) {
                    return true;
                } else {
                    Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'add':
                if (in_array($module, $aclModuleList->accessAdd, true)) {
                    return true;
                } else {
                    Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'edit':
                if (in_array($module, $aclModuleList->accessEdit, true)) {
                    return true;
                } else {
                    Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'delete':
                if (in_array($module, $aclModuleList->accessDelete, true)) {
                    return true;
                } else {
                    Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
            case 'export':
                if (in_array($module, $aclModuleList->accessExport, true)) {
                    return true;
                } else {
                    Session::put('permission_error', 'you have not permission to access this page.please contact to your administrator!');
                    return false;
                }
        }
        return true;
    }

    // private function checkUserPermission()
    // {
    //     $user = Auth::user();
    //     $role_id = $user->role_id;
    //     if ($role_id == 1) {
    //         return true;
    //     }

    //     $request_body = file_get_contents('php://input');
    //     $currenturl = URL::full();

    //     $routeName = Route::currentRouteName();
    //     $routeArray = app('request')->route()->getAction();
    //     // print_r($routeArray);die;
    //     $data = json_decode($request_body);
    //     if (!empty($data->controller)) {
    //         $route = explode('.', $data->controller);
    //         $route = explode('Controller', $route[count($route) - 1])[0];
    //         $path = explode('/', $data->path);
    //         $path = $path[count($path) - 1];
    //         $permissions = DB::table('user_roles')->where('id', $role_id)->first()->permissions;
    //         if (empty($permissions)) {
    //             die('you have not permission to access this page.please contact to your administrator!');
    //             return false;
    //         } else {
    //             $permissions = json_decode(json_decode((string) $permissions, true, 512, JSON_THROW_ON_ERROR));
    //             if ($path == 'edit') {
    //                 $permissions = $permissions->accessEdit;
    //             } elseif ($path == 'new') {
    //                 $permissions = $permissions->accessAdd;
    //             } else {
    //                 $permissions = $permissions->accessList;
    //             }
    //         }
    //         if (!in_array($route, $permissions, true)) {
    //             die('you have not permission to access this page.please contact to your administrator!');
    //             return false;
    //         } else {
    //             return true;
    //         }
    //     }
    //     return false;
    // }
}
