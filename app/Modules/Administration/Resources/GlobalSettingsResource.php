<?php
namespace App\Modules\Administration\Resources;

use App\Models\GlobalSettings;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
class GlobalSettingsResource extends JsonResource
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
            'branch_id'         => $this->branch_id,
            'status'            => $this->status,
            'status_number'     => $this->status_number,
            'last_run_date'     => $this->last_run_date,
            'other_configs'     => $this->other_configs,
            'description'       => $this->description,
            'date_entered'      => date('d-m-Y',strtotime($this->date_entered)),
            'date_modified'     => date('d-m-Y',strtotime($this->date_modified)),
        ];
    }
}

?>
