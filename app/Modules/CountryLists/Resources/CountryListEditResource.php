<?php

namespace App\Modules\CountryLists\Resources;

use App\Models\CountryList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Common\Datetime\TimeDate;
use JsonException;

class CountryListEditResource extends JsonResource
{
    public function toArray($request)
    {
        $datetime = new TimeDate();
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'isd_code'             => $this->isd_code,
            'status'             => $this->status,
            'date_entered'      => $datetime->to_display_date_time($this->date_entered),
            'date_modified'     => $datetime->to_display_date_time($this->date_modified),
        ];
    }
}
