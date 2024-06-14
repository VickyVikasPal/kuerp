<?php
namespace App\Modules\Invoices;

use App\Models\Invoice;
use App\Models\ClientMaster;
use App\Models\InvoiceItem;
use App\Modules\Invoices\Resources\InvoiceResource;
use DB;

class ListView{

    public function get_list($request){
        $where = array();
       // array_push($where,array('deleted','0'));
       $next_array = array();
        $text = array();
       $dateArr = array();
       $dateKey = '';
       $where = ['deleted'=>'0'];
        if($request->get('search') !=''){
            $searchItems = json_decode($request->get('search'));
            foreach ($searchItems as $key => $value) {
                
                if($value !='' && !is_object($value)){
                     if($this->isDate($value) == true){
                        array_push($dateArr,date("Y-m-d h:i:s",strtotime($value)));
                        $key_date = explode("_",$key);
                        $dateKey = $key_date[0];
                     }else{
                        $text[$key]=$value;
                     }
                        
                }else if($value !='' && is_object($value)){
                    $obj_value = get_object_vars($value);
                    $text[$key]=$obj_value['value'];
                }else{

                }                         
            }
        }
        
      $next_array = array_merge($where,$text);
     // print_r($next_array);
    

    

       /// $sort = json_decode($request->get('sort', json_encode(['order' => 'desc', 'column' => 'created_at'], JSON_THROW_ON_ERROR)), true, 512, JSON_THROW_ON_ERROR);
            //$items = Product::where($next_array)
            $sort = $request->get('sort');
            if(count($dateArr)> 0){
            $dateRange = [$dateArr[0],$dateArr[1]];

            $items = Invoice::where($next_array)
            ->whereBetween($dateKey, $dateRange)
            ->orderBy($sort['column'], $sort['order'])
            ->paginate((int) $request->get('perPage', 10)); 

             }
             else{
            $items = Invoice::where($next_array)
            ->orderBy($sort['column'], $sort['order'])
            ->paginate((int) $request->get('perPage', 10)); 
             }
 
        $array =   [
        'items' => InvoiceResource::collection($items->items()),
        'pagination' => [
            'currentPage' => $items->currentPage(),
            'perPage' => $items->perPage(),
            'total' => $items->total(),
            'totalPages' => $items->lastPage()
        ]
        ];
            return $array;
    }

   /**
 * Check if the value is a valid date
 *
 * @param mixed $value
 *
 * @return boolean
 */
function isDate($value) 
{
    if (!$value) {
        return false;
    }

    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

public function getProductByid($request)
{
    $product = new Invoice();

    $data = $product->retrieve($request->get('delivery_id'));

    return response()->json(['delivery'=>$data]);
}

public function getDelivery($request)
{
     $purchase_data = Invoice::find($request->delivery_id);
    $client = ClientMaster::find($purchase_data->parent_id);

   $item_data = DB::table('delivery_items')->where('parent_id', $request->delivery_id)->where('deleted', 0)->get();

   return response()->json(['delivery_id'=>$request->purchase_id, 'client'=>$client, 'delivery_data'=>$purchase_data, 'item_data'=>$item_data]);
}

public function getCustomerById($request)
{
    $client = ClientMaster::find($request->get('customer_id'));

    return response()->json(['client'=>$client], 200);
}

}