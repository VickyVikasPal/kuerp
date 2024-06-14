<?php
namespace App\Modules\Sequences;

use App\Models\Sequence;
use App\Modules\Sequences\Resources\SequenceResource;

class ListView
{
    public function getDatas($request)
    {
       // $sort = json_decode($request->get('sort', json_encode(['order' => 'asc', 'column' => 'date_entered'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
       $sort = $request->get('sort');
        if($request->get('search') !=''){
            $items = Sequence::where('deleted','=','0')
            ->where('branch_id','=',$request->get('search'))
            ->orderBy($sort['column'], $sort['order'])
            ->paginate((int) $request->get('perPage', 10)); 
        }else{
            $items = Sequence::where('deleted','=','0')
            ->orderBy($sort['column'], $sort['order'])
            ->paginate((int) $request->get('perPage', 10)); 
        }
        
       // return response()->json(['items' => SequenceResource::collection($items)]);
       
       $array =   [
        'items' => SequenceResource::collection($items->items()),
        'pagination' => [
            'currentPage' => $items->currentPage(),
            'perPage' => $items->perPage(),
            'total' => $items->total(),
            'totalPages' => $items->lastPage()
        ]
        ];
            return $array;
    }
    public function export()
    {
        $ids = request()->input('ids')??'';
        $all = request()->input('all')??'';
        $items = Sequence::filter()->when(request()->input('all'), function ($query) {
           // return $query->whereIn('id', 'desc');
        }, function ($items) {
            return $items->whereIn('id',request()->input('ids'));
        })->where('deleted', null)->where('branch_id', null)->get();
       // return response()->json(['items' => UserResource::collection($query)]);

       $array =   [
        'items' => SequenceResource::collection($items->items()),
        'pagination' => [
            'currentPage' => $items->currentPage(),
            'perPage' => $items->perPage(),
            'total' => $items->total(),
            'totalPages' => $items->lastPage()
        ]
        ];
            return $array;
    }
}
