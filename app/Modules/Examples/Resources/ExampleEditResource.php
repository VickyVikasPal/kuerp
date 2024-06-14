<?php

namespace App\Modules\Examples\Resources;

use App\Models\Example;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Common\Datetime\TimeDate;
use JsonException;

class ExampleEditResource extends JsonResource
{
    public function toArray($request)
    {
        $datetime = new TimeDate();
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'gender'            => $this->gender,
            'dob'               => $datetime->to_display_date_time($this->date_entered),
            'image'             => $this->image,
            'qualification'     => $this->qualification,
            'hobbies'           => $this->hobbies,
            'date_entered'      => $datetime->to_display_date_time($this->date_entered),
            'date_modified'     => $datetime->to_display_date_time($this->date_modified),
        ];
    }
}
