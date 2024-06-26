<?php
namespace App\Modules\Branchs\Pdf;
/*********************************************************************************
 * This program is developed by Softdev Infotech Pvt. Ltd.
 * Copyright Softdev Infotech Pvt. Ltd. 2023
 *********************************************************************************/

use Illuminate\Http\Request;
use App\Common\Healpdf;
class HealBranch extends Healpdf
{
       public function display(Request $request,$id)
        {
                $this->parentDisplay(); // Set some content to print
                $html = '<h1>Welcome to <a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
                <i>This is the first example of TCPDF library.</i>
                <p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
                <p>Please check the source code documentation and other examples for further information.</p>
                <p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
                EOD';
                $this->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                $this->Output('Testt.pdf', 'I');
        }
}
