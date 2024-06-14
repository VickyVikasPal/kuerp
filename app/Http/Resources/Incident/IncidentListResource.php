<?php

namespace App\Http\Resources\Incident;

use App\Http\Resources\Component\ComponentResource;
use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidentListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Incident $incident */
        $incident = $this;
        return [
            'id' => $incident->id,
            'uuid' => $incident->uuid,
            'name' => $incident->name,
            'type' => $incident->type,
            'impact' => $incident->impact,
            'start_at' => $incident->start_at ? $incident->start_at->toISOString() : null,
            'end_at' => $incident->end_at ? $incident->end_at->toISOString() : null,
            'last_history' => new IncidentHistoryResource($incident->incidentHistories->last()),
            'components' => ComponentResource::collection($incident->components)
        ];
    }
}
