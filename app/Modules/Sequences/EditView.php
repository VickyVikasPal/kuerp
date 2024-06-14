<?php
namespace App\Modules\Sequences;

use App\Models\Sequence;
use App\Modules\Sequences\Resources\SequenceResource;
use Illuminate\Support\Facades\Auth;

class EditView
{
    public function addData($request)
    {
        $request->validated();
        $sequence = new Sequence();
        $user = Auth::user();
        //gmdate('Y-m-d H:i:s');
        if($request->get('period') == 'Y')
        {
            $sequence_format = gmdate('Y');
        }
        if($request->get('period') == 'YM')
        {
            $sequence_format = gmdate('Ym');
        }
        if($request->get('period') == 'YMD')
        {
            $sequence_format = gmdate('Ymd');
        }
    
        $sequence->name           = $request->get('name');
        $sequence->sequence_type  = $request->get('sequence_type');
        $sequence->period         = $request->get('period');
        $sequence->period_format  = $sequence_format;
        $sequence->seq_no         = $request->get('seq_no');
        $sequence->branch_id      = (!empty($request->get('branch_id'))) ? $request->get('branch_id') : $user->branch_id;
        $sequence->field_name     = $request->get('field_name');
        $sequence->prefix         = $request->get('prefix');
        $sequence->date_field     = $request->get('date_field');
        
        if ($sequence->save()) {
            return response()->json(['message' => 'Data saved correctly', 'sequence' => new SequenceResource($sequence)]);
        }
        return response()->json(['message' => __('An error occurred while saving data')], 500);

    }
}
