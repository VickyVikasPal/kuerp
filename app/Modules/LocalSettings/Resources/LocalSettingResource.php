<?php
namespace App\Modules\LocalSettings\Resources;

use App\Models\LocalSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
class LocalSettingResource extends JsonResource
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
        ];
    }
}
