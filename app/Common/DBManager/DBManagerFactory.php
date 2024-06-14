<?php
/*********************************************************************************
 * This program is developed by SoftDev A & A Soft Solutions.
* Copyright SoftDev A & A Soft Solutions. 2010
* Developed By VK
*********************************************************************************/
namespace App\Common\DBManager;

use Illuminate\Support\Facades\DB;

class DBManagerFactory
{
    public static function getInstance()
    {
        $db = new DB();;
        return $db;
    }
}
?>