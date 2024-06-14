<?php
namespace App\Modules\Payments\Resources;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
use App\Common\Datetime\TimeDate;

class PaymentResource extends JsonResource
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
        /** @var Payment $user */
        $payments = $this;
        $datetime = new TimeDate();
        
        //echo "<pre>";print_r((new UserRoleResource($user->userRole)));die;
        return [
            'id'                => $payments->id,
            'name'              => $payments->name,
            'date_entered'      => $datetime->to_display_date_time($payments->date_entered),
            'status'            => $payments->status,
            
        ];
    }
}
