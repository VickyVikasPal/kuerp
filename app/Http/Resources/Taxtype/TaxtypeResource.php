<?php

namespace App\Http\Resources\Taxtype;

use App\Models\Taxtype;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;

class TaxtypeResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        /** @var Taxtype $user */
        $taxtype = $this;
                
        return [
            'id' => $taxtype->id,
            'name' => $taxtype->name,
            'tax' => $taxtype->tax,
            'status' => $taxtype->status,
            'description' => $taxtype->description,
            'created_at' => $taxtype->created_at->toISOString(),
            'updated_at' => $taxtype->updated_at->toISOString(),
            
        ];

      
    }
}
