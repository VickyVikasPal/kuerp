<?php
namespace App\Modules\Examples\Resources;

use App\Models\Example;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Common\Datetime\TimeDate;
use App\Modules\Branchs\Resources\BranchResource;
use JsonException;

class ExampleResource extends JsonResource
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
            'branch_id'         => $this->branch_id,
            'parent_id'         => $this->parent_id,
            'parent_type'       => $this->parent_type,
            'branch_name'       => (new BranchResource($this->branch))->name??'',
            'dob'               => $datetime->to_display_date($this->dob,false),
            'image1'            => $this->image,
            'image'             =>  '/uploads/'.date('Y',strtotime($this->date_entered)).'/'.date('m',strtotime($this->date_entered)).'/'.$this->image,
            'qualification'     => $this->qualification,
            'hobbies'           => $this->hobbies,
            'date_entered'      => $datetime->to_display_date_time($this->date_entered),
            'date_modified'     => $datetime->to_display_date_time($this->date_modified),
        ];
    }
}
