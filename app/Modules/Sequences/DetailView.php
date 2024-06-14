<?php
namespace App\Modules\Sequences;

use App\Modules\Sequences\Resources\SequenceResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use App\Models\Sequence;
use Route;
use Setting;
use Str;
use Illuminate\Support\Facades\Auth;

class DetailView
{
    public function updateData($request, $sequence)
    {
        $request->validated();
        $user = Auth::user();
        
        $sequence = Sequence::find($request->get('id'));
        $sequence->name           = $request->get('name');
        $sequence->sequence_type           = $request->get('sequence_type');
        $sequence->period            = $request->get('period');
        $sequence->seq_no             = $request->get('seq_no');
        $sequence->branch_id      = (!empty($request->get('branch_id'))) ? $request->get('branch_id') : $user->branch_id;
        $sequence->field_name             = $request->get('field_name');
        $sequence->prefix             = $request->get('prefix');
        $sequence->date_field             = $request->get('date_field');
        if ($sequence->save()) {
            return array('message'=>'success');
        }else{
            return array('message'=>'fail');
        }
        //return response()->json(['message' => __('An error occurred while saving data')], 500);
    }
    public function showData($module)
    {
        $authUser = Auth::user();
       /*  if ($module->id === $authUser->id) {
            return response()->json(['message' => __('Can not edit your user from the user manager, go to your account page')], 406);
        } */
        return response()->json(new SequenceResource($module));
    }
    public function deleteData($module)
    {
        if ($module->delete()) {
            return response()->json(['message' => 'Data deleted successfully']);
        }
        return response()->json(['message' => __('An error occurred while deleting data')], 500);
    }
}
