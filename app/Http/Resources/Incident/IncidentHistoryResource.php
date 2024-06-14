<?php

namespace App\Http\Resources\Incident;

use App\Models\IncidentHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidentHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var IncidentHistory $incidentHistory */
        $incidentHistory = $this;
        return [
            'id' => $incidentHistory->id,
            'message' => $incidentHistory->message,
            'status' => $incidentHistory->status,
            'created_at' => $incidentHistory->created_at->toISOString(),
        ];
    }
}
