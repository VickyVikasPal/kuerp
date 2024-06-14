<?php

namespace App\Http\Resources\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Setting $setting */
        $setting = $this;
        return [
            'key' => (string) $setting->key,
            'value' => $setting->decodeValue(),
        ];
    }
}
