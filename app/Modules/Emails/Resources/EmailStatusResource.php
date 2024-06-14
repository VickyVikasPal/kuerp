<?php
namespace App\Modules\Emails\Resources;

use App\Models\EmailStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
use App\Common\Datetime\TimeDate;
class EmailStatusResource extends JsonResource
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
        $datetime = new TimeDate();
        return [
            'id' => $this->id,
            'fromname' => $this->fromname,
            'fromaddress' => $this->fromaddress,
            'smtpuser' => $this->smtpuser,
            'subject' => $this->subject,
            'to' => $this->to,
            'cc' => $this->cc,
            'bcc' => $this->bcc,
            'attachment_name' => basename($this->attachment),
            'attachment' => url($this->attachment),
            'html' => $this->html,
            'request_from' => $this->request_from,
            'date_sent' => $datetime->to_display_date_time($this->date_sent),
            'status' => $this->status,
            'reply_to_status' => $this->reply_to_status,
        ];
    }
}
