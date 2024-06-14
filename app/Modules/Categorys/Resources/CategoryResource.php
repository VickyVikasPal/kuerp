<?php
namespace App\Modules\Categorys\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;
use App\Common\Datetime\TimeDate;

class CategoryResource extends JsonResource
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
        /** @var Category $user */
        $category = $this;
        $datetime = new TimeDate();
        
        //echo "<pre>";print_r((new UserRoleResource($user->userRole)));die;
        return [
            'id'                => $category->id,
            'name'              => $category->name,
            'date_entered'      => $datetime->to_display_date_time($category->date_entered),
            'status'            => $category->status,
            
        ];
    }
}
