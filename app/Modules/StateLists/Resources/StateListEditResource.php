<?php

namespace App\Modules\StateLists\Resources;

use App\Models\StateList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Common\Datetime\TimeDate;
use JsonException;

class StateListEditResource extends JsonResource
{
    public function toArray($request)
    {
        $datetime = new TimeDate();
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'parent_type'       => $this->parent_type,
            'parent_id'         => $this->parent_id,
            'status'            => $this->status,
            'date_entered'      => $datetime->to_display_date_time($this->date_entered),
            'date_modified'     => $datetime->to_display_date_time($this->date_modified),
        ];
    }
}
