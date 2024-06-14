<?php
namespace App\Modules\Examples\Pdf;
/* ********************************************************************************
 * This program is developed by Softdev Infotech Pvt. Ltd.
 * Copyright Softdev Infotech Pvt. Ltd. 2023
 ******************************************************************************** */

use Illuminate\Http\Request;
use App\Common\Healpdf;
class HealExample extends Healpdf
{
        public function display(Request $request, $id)
        {
                $this->LogInfo('Begin: Examples.HealPdf->display()');
                $this->parentDisplay(); // Set some content to print                
                $html = "Hellu";
                $this->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                $this->Output('Testt.pdf', 'I');
        }
}
