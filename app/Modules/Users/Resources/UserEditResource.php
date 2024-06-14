<?php

namespace App\Modules\Users\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;

class UserEditResource extends JsonResource
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
        $user = $this;
        return [
            'id' => $user->id,
            'name' => $user->name,
            'type' => $user->type,
        ];
    }
}
