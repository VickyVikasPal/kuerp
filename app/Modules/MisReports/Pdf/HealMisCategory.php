<?php
/*********************************************************************************
 * This program is developed by Softdev Infotech Pvt. Ltd.
 * Copyright Softdev Infotech Pvt. Ltd. 2023
 *********************************************************************************/
namespace App\Modules\MisReports\Pdf;

use App\Common\Datetime\TimeDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Common\Healpdf;
use Illuminate\Support\Facades\DB;

class HealMisCategory extends Healpdf
{
    
    public function display(Request $request)
    {
        $user = Auth::user();
        $dateTime = new TimeDate();

        $this->parentDisplay();
       
        $fileName = $request->get('reportName').'.pdf';

        $total_price = 0;

        $date_range1 = $dateTime->to_db_datetime($request->get('dateRange1'));
        
        $date_range2 = $dateTime->to_db_datetime($request->get('dateRange2'));

        $table_head = array('Category Name', 'Sub Category', 'Product Name', 'Product Price');
        
        $datas = DB::table('categorys')
                ->leftJoin('subcategorys', 'categorys.id', '=', 'subcategorys.parent_id')
                ->leftJoin('products', 'categorys.id', '=', 'products.parent_id')
                ->select('categorys.name as category_name', 'subcategorys.name as subcategory_name', 'products.name as product_name', 'products.price as product_price')
                ->where('products.status','Active')
                ->where('products.deleted',0)
                ->where('categorys.id', $request->get('category_id'))
                ->where('products.branch_id', $user->branch_id)
                ->get();


// Set some content to print
        $html = '';
        $html .= '<table border="2" style="text-align: center;">';
        $html .= '<thead>';
        $html .= '<tr>';
        foreach ($table_head as $key => $value) {
                $html .='<th>'.$value.'</th>';
        }
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($datas as $data) {
                $html .='<tr>';
                $html .='<td>'.$data->category_name.'</td>';
                $html .='<td>'.$data->subcategory_name.'</td>';
                $html .='<td>'.$data->product_name.'</td>';               
                $html .='<td>'.$data->product_price.'</td>';
                $html .='</tr>';
                $total_price += $data->product_price;
        }
        $html .= '</tbody>';
        $html .='<tfoot>';
        $html .='<tr><td colspan="3"></td><td>'.$total_price.'</td></tr>';
        $html .='</tfoot>';
        $html .= '</table>';

// Print text using writeHTMLCell()
//die;
        $this->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $this->Output($fileName, 'I');

//============================================================+
        // END OF FILE
        //============================================================+
    }
}
