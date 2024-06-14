<?php
namespace App\Modules\AppList;

use App\Http\Middleware\SoftdevCheckRolePermission;

class GroupedNavbar
{
    public function Grouped_Header_Structure()
    {
        $Softdev = new SoftdevCheckRolePermission();
        //$Softdev->checkAccess('access', 'Pos')

        $data['menus'] = array(
           array(
                'head_name'=>'Home',
                'head_link'=>'/modules/home',
                'icons'=>'fa-solid fa-house',
                'sub_menu'=>array()
           ),

            array(
                'head_name'=>'Category',
                'head_link'=>'/modules/categorys',
                'icons'=>'fa-solid fa-folder',
                'sub_menu'=>array()
            ),

            array(
                'head_name'=>'Product',
                'head_link'=>'/modules/products',
                'icons'=>'fa-solid fa-folder',
                'sub_menu'=>array()
            ),
            array(
                'head_name'=>'Client Master',
                'head_link'=>'/modules/clientmasters',
                'icons'=>'fas fa-mug-hot',
                'sub_menu'=>array()
            ),
            array(
                'head_name'=>'Vendor Master',
                'head_link'=>'/modules/vendormasters',
                'icons'=>'fas fa-user-tag',
                'sub_menu'=>array()
            ),
            array(
                'head_name'=>'Purchase',
                'head_link'=>'/modules/purchases',
                'icons'=>'fas fa-shopping-cart',
                'sub_menu'=>array()
            ),
            array(
                'head_name'=>'Quotation',
                'head_link'=>'/modules/quotations',
                'icons'=>'fa-solid fa-quote-left',
                'sub_menu'=>array()
            ),
            array(
                'head_name'=>'Delivery Challan',
                'head_link'=>'/modules/deliverychallans',
                'icons'=>'fas fa-truck',
                'sub_menu'=>array()
            ),
           
            array(
                'head_name'=>'Invoce',
                'head_link'=>'/modules/invoices',
                'icons'=>'fas fa-file-invoice',
                'sub_menu'=>array()
            ),
            array(
                'head_name'=>'Order / PI',
                'head_link'=>'/modules/orders',
                'icons'=>'fas fa-truck',
                'sub_menu'=>array()
            ),
            array(
                'head_name'=>'MIS Reports',
                'head_link'=>'/modules/misreports',
                'icons'=>'fas fa-bug',
                'sub_menu'=>array()
            ),
            array(
                'head_name'=>'Branchs',
                'head_link'=>'/modules/branchs',
                'icons'=>'fa-solid fa-code-branch',
                'sub_menu'=>array()
            ),
            array(
                'head_name'=>'User Roles',
                'head_link'=>'/modules/userroles',
                'icons'=>'fa-solid fa-user',
                'sub_menu'=>array()
            )
        );

        return $data['menus'];
    }
}
