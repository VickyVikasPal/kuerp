<?php

namespace App\Modules\Emails\Resources;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;

class EmailEditResource extends JsonResource
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
        /** @var Email $userRole */
        $email = $this;
        return [
            'id' => $email->id,
            'name' => $email->name,
        ];
    }
}
