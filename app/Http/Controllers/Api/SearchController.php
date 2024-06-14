<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Exception;

use Illuminate\Http\Request;
use JsonException;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    public function searchItem(Request $request)
    {
        
        $searchQuery =  $request->get('data');
        $module = str_replace('-','_',$request->get('relatedModule'));
        
        $result = DB::table($module)->where('name','LIKE',"%{$searchQuery}%")->get();

        return response()->json($result);
    }
}
