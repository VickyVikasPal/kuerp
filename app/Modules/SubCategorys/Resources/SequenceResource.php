<?php
namespace App\Modules\Sequences\Resources;

use App\Models\Sequence;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonException;

class SequenceResource extends JsonResource
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
        /** @var User $user */
        $sequence = $this;
        //echo "<pre>";print_r((new UserRoleResource($user->userRole)));die;
        return [
            'id'                => $sequence->id,
            'name'              => $sequence->name,
            'date_entered'      => $sequence->date_entered,
            'date_modified'     => $sequence->date_modified,
            'modified_user_id'  => $sequence->modified_user_id,
            'created_by'        => $sequence->created_by,
            'description'       => $sequence->description,
            'sequence_type'     => $sequence->sequence_type,
            'period'            => $sequence->period,
            'seq_no'            => $sequence->seq_no,
            'branch_id'         => $sequence->branch_id,
            'field_name'        => $sequence->field_name,
            'prefix'            => $sequence->prefix,
            'date_field'        => $sequence->date_field,
            //'role'              => (new UserRoleResource($user->userRole))->name,
            //'user_role'         => (new UserRoleResource($user->userRole))->name,
            //'role_id'           => $user->role_id,
            //'status'            => $user->status=='1'?'Enabled':'Disabled',
            
        ];
    }
}
