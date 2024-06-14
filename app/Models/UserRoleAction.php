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


class UserRoleAction extends SoftdevModel
{
    use HasFactory, HasApiTokens, Notifiable;

    public static $auditingDisabled = false; // if true then audit will be disabled
    public $individualAudit = true; // if true then audit data will be inserted this particlur model table
    
    protected $auditInclude = [
        'name',
        'status',
    ];

    public $table = "user_roles_actions";

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
    public function newQuery()
    {
        // Check if the query is eager loading the  relationship
        $isEagerLoadingOpportunity = collect(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))
            ->pluck('function')
            ->contains('userRoleAction');

        if (!$isEagerLoadingOpportunity)
        {
            // If not eager loading  apply the 'withPermissions()' scope
            return parent::newQuery()->withPermissions();
        }

        return parent::newQuery();
    }
}
