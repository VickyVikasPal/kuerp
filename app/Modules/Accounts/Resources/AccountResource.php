<?php
namespace App\Modules\Accounts\Resources;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
class AccountResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'avatar' => $this->avatar,
            'avatar_path' => '/uploads/' . date('Y', strtotime($this->date_entered)) . '/' . date('m', strtotime($this->date_entered)) . '/' . $this->avatar,
            'date_entered' => date('d-m-Y', strtotime($this->date_entered)),
            'date_modified' => date('d-m-Y', strtotime($this->date_modified)),
        ];
    }
}
