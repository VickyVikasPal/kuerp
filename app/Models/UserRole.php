<?php

namespace App\Models;

use App\Common\SoftdevModel;
use Eloquent;
//use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use JsonException;
use Route;


class UserRole extends SoftdevModel
{
    use HasFactory, HasApiTokens, Notifiable;

    public static $auditingDisabled = false; // if true then audit will be disabled
    public $individualAudit = true; // if true then audit data will be inserted this particlur model table
    
    protected $auditInclude = [
        'name',
        'status',
    ];

    public $table = "user_roles";

    protected $primaryKey = 'id'; // or null
    const CREATED_AT = 'date_entered';
   // const created_at = 'date_entered'; // or null
    const UPDATED_AT = 'date_modified'; // or null

    public $incrementing = false;

    protected $casts = [
        'permissions' => 'json',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
    public function getPermissions(): array
    {
        $controllers = [];
        if(!empty($this->permissions) && $this->permissions != 'null'){
            
            $response = json_decode((string) $this->permissions, true, 512, JSON_THROW_ON_ERROR);
        }else{
            $response = array();
        }
        return $response;
    }
    public function checkPermission($route = '', $path = ''): bool
    {
        return true;
    }
}
