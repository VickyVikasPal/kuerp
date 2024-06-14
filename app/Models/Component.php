<?php

namespace App\Models;

use App\Http\Resources\Incident\IncidentResource;
use Eloquent;
//use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * App\Models\Component
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property int $order
 * @property string|null $description
 * @property int $display_uptime
 * @property Carbon|null $start_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Incident[] $incidents
 * @property-read int|null $incidents_count
 * @method static Builder|Component filter($input = [], $filter = null)
 * @method static Builder|Component newModelQuery()
 * @method static Builder|Component newQuery()
 * @method static Builder|Component ordered($direction = 'asc')
 * @method static Builder|Component paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Component query()
 * @method static Builder|Component simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Component whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|Component whereCreatedAt($value)
 * @method static Builder|Component whereDescription($value)
 * @method static Builder|Component whereDisplayUptime($value)
 * @method static Builder|Component whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|Component whereId($value)
 * @method static Builder|Component whereLike($column, $value, $boolean = 'and')
 * @method static Builder|Component whereName($value)
 * @method static Builder|Component whereOrder($value)
 * @method static Builder|Component whereStartAt($value)
 * @method static Builder|Component whereStatus($value)
 * @method static Builder|Component whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Component extends Model implements Sortable
{

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $casts = [
        'start_at' => 'date',
    ];

    public function incidentsInLast90Days(): array
    {
        $start_date = Carbon::now()->subDays(89);
        $end_date = Carbon::now()->addDay();
        $incidents = [];
        if ($this->display_uptime) {
            for ($date = $start_date->copy(); $date->lessThan($end_date); $date->addDay()) {
                $incidentsList = [];
                $dateString = $date->toDateString();
                if ($date->greaterThanOrEqualTo($this->start_at)) {
                    $incidentsList = $this->incidents()
                        ->whereDate('start_at', '<=', $dateString)
                        ->where(static function ($query) use ($dateString) {
                            $query->whereDate('end_at', '>=', $dateString)
                                ->orWhereNull('end_at');
                        })
                        ->orderByDesc('created_at')
                        ->get();
                    $incidentsCount = $this->incidents()
                        ->where('type', 1)
                        ->whereDate('start_at', '<=', $dateString)
                        ->where(static function ($query) use ($dateString) {
                            $query->whereDate('end_at', '>=', $dateString)
                                ->orWhereNull('end_at');
                        })
                        ->count();
                    $scheduleMaintenance = $this->incidents()
                        ->where('type', 2)
                        ->whereDate('start_at', '<=', $dateString)
                        ->where(static function ($query) use ($dateString) {
                            $query->whereDate('end_at', '>=', $dateString)
                                ->orWhereNull('end_at');
                        })
                        ->count();
                    if ($scheduleMaintenance === 0 && $incidentsCount === 0) {
                        $resume = 'green';
                    } elseif ($scheduleMaintenance >= $incidentsCount) {
                        $resume = 'blue';
                    } elseif ($incidentsCount !== 0) {
                        $incidentType = $this->incidents()->where('type', 1)
                            ->whereDate('start_at', '<=', $dateString)
                            ->where(static function ($query) use ($dateString) {
                                $query->whereDate('end_at', '>=', $dateString)
                                    ->orWhereNull('end_at');
                            })
                            ->orderByDesc('impact')
                            ->first(['impact'])['impact'];
                        switch ($incidentType) {
                            case 2:
                                $resume = 'yellow';
                                break;
                            case 3:
                                $resume = 'orange';
                                break;
                            case 4:
                                $resume = 'red';
                                break;
                            default:
                                $resume = 'green';
                                break;
                        }
                    } else {
                        $resume = 'green';
                    }
                } else {
                    $resume = 'gray';
                }
                $incidents[$dateString] = [
                    'resume' => $resume,
                    'list' => IncidentResource::collection($incidentsList)
                ];
            }
        }
        return $incidents;
    }

    public function incidents(): BelongsToMany
    {
        return $this->belongsToMany(Incident::class, 'incident_components');
    }
}
