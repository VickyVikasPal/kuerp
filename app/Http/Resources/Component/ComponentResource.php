<?php

namespace App\Http\Resources\Component;

use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComponentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Component $component */
        $component = $this;
        return [
            'id' => $component->id,
            'name' => $component->name,
            'status' => $component->status,
            'description' => $component->description,
            'display_uptime' => $component->display_uptime,
            'start_at' => $component->start_at ? $component->start_at->toISOString() : null,
            'order' => $component->order,
        ];
    }
}
