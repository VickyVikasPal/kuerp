<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\IncidentHistory
 *
 * @property int $id
 * @property int $incident_id
 * @property int $user_id
 * @property string $message
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|IncidentHistory newModelQuery()
 * @method static Builder|IncidentHistory newQuery()
 * @method static Builder|IncidentHistory query()
 * @method static Builder|IncidentHistory whereCreatedAt($value)
 * @method static Builder|IncidentHistory whereId($value)
 * @method static Builder|IncidentHistory whereIncidentId($value)
 * @method static Builder|IncidentHistory whereMessage($value)
 * @method static Builder|IncidentHistory whereStatus($value)
 * @method static Builder|IncidentHistory whereUpdatedAt($value)
 * @method static Builder|IncidentHistory whereUserId($value)
 * @mixin Eloquent
 */
class IncidentHistory extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
