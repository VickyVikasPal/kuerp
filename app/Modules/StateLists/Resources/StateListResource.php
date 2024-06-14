<?php
namespace App\Modules\StateLists\Resources;

use App\Models\StateList;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Common\Datetime\TimeDate;
use JsonException;
use App\Modules\CountryLists\Resources\CountryListResource;

class StateListResource extends JsonResource
{   
    public function toArray($request)
    {   
        $datetime = new TimeDate();
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'parent_type'       => $this->parent_type,
            'parent_id'         => $this->parent_id,
            'countrylist_name' => (new CountryListResource($this->country_List))->name??'',
            'status'            => $this->status,
            'date_entered'      => $datetime->to_display_date_time($this->date_entered),
            'date_modified'     => $datetime->to_display_date_time($this->date_modified),
        ];
    }
}
