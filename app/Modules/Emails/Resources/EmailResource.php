<?php
namespace App\Modules\Emails\Resources;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
class EmailResource extends JsonResource
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
            'id' => $this->id,
            'fromname' => $this->fromname,
            'fromaddress' => $this->fromaddress,
            'smtpserver' => $this->smtpserver,
            'smtpport' => $this->smtpport,
            'smtpuser' => $this->smtpuser,
            'smtppassword' => $this->smtppassword,
        ];
    }
}
