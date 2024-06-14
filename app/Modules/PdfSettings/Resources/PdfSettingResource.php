<?php
namespace App\Modules\PdfSettings\Resources;

use App\Models\PdfSetting;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
class PdfSettingResource extends JsonResource
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
