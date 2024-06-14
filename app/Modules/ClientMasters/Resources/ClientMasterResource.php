<?php
namespace App\Modules\ClientMasters\Resources;

use App\Models\ClientMaster;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
use App\Common\Datetime\TimeDate;

class ClientMasterResource extends JsonResource
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
        /** @var ClientMaster $user */
        $clientmaster = $this;
        $datetime = new TimeDate();
        
        //echo "<pre>";print_r((new UserRoleResource($user->userRole)));die;
        return [
            'id' => $clientmaster->id,
            'client_id' => $clientmaster->client_id,
            'name' => $clientmaster->name,
            'firm_name' => $clientmaster->firm_name,
            'contact_no' => $clientmaster->contact_no,
            'client_email' => $clientmaster->client_email,
            'gst_status' => $clientmaster->gst_status,
            'gst_number' => $clientmaster->gst_number,
            'address' => $clientmaster->address,
            'area' => $clientmaster->area,
            'state' => $clientmaster->state,
            'pin_no' => $clientmaster->pin_no,  
            'date_entered' => $datetime->to_display_date_time($clientmaster->date_entered),
            'date_modified' => $datetime->to_display_date_time($clientmaster->date_modified),
            'status' => $clientmaster->status == 1 ? 'Active':'Inactive',
            
        ];
    }
}
