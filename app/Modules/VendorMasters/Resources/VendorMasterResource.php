<?php
namespace App\Modules\VendorMasters\Resources;

use App\Models\VendorMaster;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
use App\Common\Datetime\TimeDate;

class VendorMasterResource extends JsonResource
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
        /** @var VendorMaster $user */
        $vendormaster = $this;
        $datetime = new TimeDate();
        
        //echo "<pre>";print_r((new UserRoleResource($user->userRole)));die;
        return [
            'id' => $vendormaster->id,
            'vendor_id' => $vendormaster->vendor_id,
            'name' => $vendormaster->name,
            'firm_name' => $vendormaster->firm_name,
            'contact_no' => $vendormaster->contact_no,
            'vendor_email' => $vendormaster->vendor_email,
            'gst_status' => $vendormaster->gst_status,
            'gst_number' => $vendormaster->gst_number,
            'address' => $vendormaster->address,
            'area' => $vendormaster->area,
            'state' => $vendormaster->state,
            'pin_no' => $vendormaster->pin_no,  
            'date_entered' => $datetime->to_display_date_time($vendormaster->date_entered),
            'date_modified' => $datetime->to_display_date_time($vendormaster->date_modified),
            'status' => $vendormaster->status == 1 ? 'Active':'Inactive',
            
        ];
    }
}
