<?php
namespace App\Modules\Branchs\Resources;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
class BranchResource extends JsonResource
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
        
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'branch_code'       => $this->branch_code,
            'ip_address'        => $this->ip_address,
            'description'       => $this->description,
            'upload_path'       => $this->upload_path,
            'for_mobileapp'     => $this->for_mobileapp,
            'default_branch'    => $this->default_branch,
            'status'            => $this->status,
            'date_entered'      => date('d-m-Y',strtotime($this->date_entered)),
            'date_modified'     => date('d-m-Y',strtotime($this->date_modified)),
        ];
    }
}
