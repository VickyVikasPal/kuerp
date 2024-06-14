<?php

namespace App\Modules\Schedulers\Resources;

use App\Models\Scheduler;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;

class SchedulerEditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     * @throws JsonException
     */
    public function toArray($request)
    {
        $scheduler = $this;
        return [
            'id' => $scheduler->id,
            'name' => $scheduler->name,
            'type' => $scheduler->type,
        ];
    }
}
