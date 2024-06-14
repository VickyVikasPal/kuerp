<?php

namespace App\Models;

use Eloquent;
//use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Incident
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property int $type
 * @property int|null $impact
 * @property Carbon|null $start_at
 * @property Carbon|null $end_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Component[] $components
 * @property-read int|null $components_count
 * @property-read Collection|IncidentHistory[] $incidentHistories
 * @property-read int|null $incident_histories_count
 * @method static Builder|Incident filter($input = [], $filter = null)
 * @method static Builder|Incident newModelQuery()
 * @method static Builder|Incident newQuery()
 * @method static Builder|Incident paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Incident query()
 * @method static Builder|Incident simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Incident whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|Incident whereCreatedAt($value)
 * @method static Builder|Incident whereEndAt($value)
 * @method static Builder|Incident whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|Incident whereId($value)
 * @method static Builder|Incident whereImpact($value)
 * @method static Builder|Incident whereLike($column, $value, $boolean = 'and')
 * @method static Builder|Incident whereName($value)
 * @method static Builder|Incident whereStartAt($value)
 * @method static Builder|Incident whereType($value)
 * @method static Builder|Incident whereUpdatedAt($value)
 * @method static Builder|Incident whereUuid($value)
 * @mixin Eloquent
 */
class Incident extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function components(): BelongsToMany
    {
        return $this->belongsToMany(Component::class, 'incident_components');
    }

    public function incidentHistories(): HasMany
    {
        return $this->hasMany(IncidentHistory::class);
    }
}
