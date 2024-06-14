<?php

namespace App\Models;

use Eloquent;
//use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Storage;
use App\Common\SoftdevModel;
use App\Models\ClientMaster;



/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $avatar
 * @property int $role_id
 * @property int $status
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $email_verified_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read Category $Category
 * @method static Builder|User filter($input = [], $filter = null)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|User query()
 * @method static Builder|User simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLike($column, $value, $boolean = 'and')
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRoleId($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 */

class DeliveryChallan extends SoftdevModel
{   
    public static $auditingDisabled = false; // if true then audit will be disabled
    public $individualAudit = true; // if true then audit data will be inserted this particlur model table
    
    protected $auditInclude = [
        'quotation_no',
        'grand_total',
        'delivery_no',
        'invoice_no',
        'status'
    ];  
    
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * name of table.
     *
     * @var array
     */
    public $table = "deliverys";

     /**
     * make auto increament false.
     *
     * @var array
     */
    protected $primaryKey = 'id'; // or null

    public $incrementing = false;
    const CREATED_AT = 'date_entered';
    const UPDATED_AT = 'date_modified';
    /**
     * Return user data
     *
     * @return BelongsTo
     */
    public function clients(): BelongsTo
    {
        return $this->belongsTo(ClientMaster::class, 'parent_id');
    }

    public static function retrieve($id)
    {
        $prod = new Product();
       return $prod->find($id);
    }
}
