<?php

//use App\Http\Controllers\Api\Account\AccountController as AccountAccountController;
use App\Http\Controllers\Api\Auth\AuthController as AuthController;

use App\Http\Controllers\Api\UserController as UserController;

use App\Http\Controllers\Api\ProductController as ProductController;
use App\Http\Controllers\Api\CategoryController as CategoryController;
use App\Http\Controllers\Api\VendorMasterController as VendorMasterController;
use App\Http\Controllers\Api\TaxtypeController as DashboardAdminTaxtypeController;
use App\Http\Controllers\Api\GlobalSettingController as GlobalSettingController;
use App\Http\Controllers\Api\UserDashletController as UserDashletController;

use App\Http\Controllers\Api\PurchaseController as PurchaseController;
use App\Http\Controllers\Api\QuotationController as QuotationController;
use App\Http\Controllers\Api\DeliveryChallanController as DeliveryChallanController;

use App\Http\Controllers\Api\SequenceController as SequenceController;

use App\Http\Controllers\Api\SubCategoryController as SubCategoryController;
use App\Http\Controllers\Api\BranchController as BranchController;
use App\Http\Controllers\Api\ExampleController as ExampleController;
use App\Http\Controllers\Api\CountryListController as CountryListController;
use App\Http\Controllers\Api\StateListController as StateListController;
use App\Http\Controllers\Api\Status\StatusController;
use App\Http\Controllers\Api\UserRoleController as UserRoleController;
use App\Http\Controllers\Api\EmailController as EmailController;
use App\Http\Controllers\Api\SystemSettingController as SystemSettingController;
use App\Http\Controllers\Api\LocalSettingController as LocalSettingController;
use App\Http\Controllers\Api\PdfSettingController as PdfSettingController;
use App\Http\Controllers\Api\EmailStatusController as EmailStatusController;
use App\Http\Controllers\Api\SearchController as SearchController;
use App\Http\Controllers\Api\MISController as MISController;
use App\Http\Controllers\AppListController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\InvoiceController as InvoiceController;
use App\Http\Controllers\Api\PaymentController as PaymentController;
use App\Http\Controllers\Api\SchedulerController;
use App\Http\Controllers\Api\ClientMasterController;
use App\Http\Middleware\SoftdevCheckRolePermission;
use App\Common\GlobalSettings;


use App\Common\SoftdevExport as SoftdevExport;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});
Route::group(['prefix' => 'lang'], function () {
    Route::get('/', [LanguageLanguageController::class, 'list'])->name('language.list');
    Route::get('/{lang}', [LanguageLanguageController::class, 'get'])->name('language.get');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('verify-otp', [AuthController::class, 'verifyOTP'])->name('auth.verifyOTP');
    Route::post('send-otp', [AuthController::class, 'sendOTP'])->name('auth.sendOTP');
    Route::post('resend-otp', [AuthController::class, 'reSendOTP'])->name('auth.reSendOTP');
    Route::post('reset-pass', [AuthController::class, 'resetPassword'])->name('auth.resetPassword');
    
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('recover', [AuthController::class, 'recover'])->name('auth.recover');
    Route::post('reset', [AuthController::class, 'reset'])->name('auth.reset');
    Route::get('user', [AuthController::class, 'user'])->name('auth.user');
    Route::post('check', [AuthController::class, 'check'])->name('auth.check');
    Route::post('reload-captcha', [AuthController::class, 'reloadCaptcha']);
});

Route::middleware('auth:sanctum')->group(function(){
Route::post('headList', [AppListController::class, 'getHeader'])->name('headerList');
Route::post('export', [SoftdevExport::class, 'export'])->name('export');
Route::get('pdf-settings', [AppListController::class, 'getPdfSettings'])->name('getPdfSettings');

Route::get('widgets/getwidgets', [UserDashletController::class, 'getWidgets']);
Route::post('widgets/updatewidgets',[UserDashletController::class, 'updateWidgets']);
Route::get('widgets/showDashlets',[UserDashletController::class, 'showDashlets']);
Route::get('widgets/getDashletTable',[UserDashletController::class, 'getDashletTable']);
Route::get('widgets/graphData',[UserDashletController::class, 'graphData']);



/* Route::group(['prefix' => 'account'], static function () {
    Route::post('update', [AccountAccountController::class, 'update'])->name('account.update');
    Route::post('password', [AccountAccountController::class, 'password'])->name('account.password');
}); */

Route::group(['prefix' => 'modules'], static function () {

    Route::post('quickRepair', function(Request $request){
       
        Artisan::call('cache:clear');
      
       
        Artisan::call('view:clear');
       
        
        Artisan::call('optimize:clear');
       
        Artisan::call('route:clear');

        GlobalSettings::getAllConfigs();
        
        return response()->json(['message'=>'clear']);
    });
    
    Route::get('custom_function',[MISController::class, 'callCustomFunction']);
    Route::get('appList', [AppListController::class, 'getAppList'])->name('commonroute');
});

Route::get('modules/users/loggedIn',[UserController::class, 'getLoggedInUser']);
Route::get('modules/users/loggedOut',[UserController::class, 'getLoggedOutUser']);
Route::post('generate_report',[MISController::class, 'generateReport']);

/*====== run custom url ======*/
Route::post('schedulers/getStatus',[SchedulerController::class, 'getStatus']);





Route::group(['prefix' => 'modules','middleware' => 'role_permission'], static function () {

    Route::get('getproductdata', [ProductController::class, 'getProductById']);
    Route::post('addpurchase_items', [PurchaseController::class, 'addPurchase']);
    Route::get('getpurchase_items', [PurchaseController::class, 'getPurchase']);
    Route::post('savepurchase', [PurchaseController::class, 'savePurchase']);
    Route::post('del_purchase', [PurchaseController::class, 'removeItem']);
    Route::post('update_inventory', [PurchaseController::class, 'updateInventory']);
    Route::get('getcustomers', [QuotationController::class, 'getCustomerById']);
    Route::post('del_quotation', [QuotationController::class, 'removeItem']);
    Route::post('savequotation', [QuotationController::class, 'saveQuotation']);
    Route::post('updatequotation', [QuotationController::class, 'updateQuotation']);
   // Route::get('addquotation_items', [QuotationController::class, 'addItems']);
   Route::post('move_to_delivery', [QuotationController::class, 'createDelivery']);
   Route::get('get_qtnData', [QuotationController::class, 'getQuotationPDF']);
    Route::get('get_customer', [QuotationController::class, 'getCustomerById']);


    Route::get('users/user-roles', [UserController::class, 'userRoles'])->name('users.user-roles');
    Route::apiResource('users', UserController::class);
    Route::post('users/remove',[UserController::class, 'deleteData']);
    Route::get('users/change-logs/{id}',[UserController::class, 'getChangeLogs']);

    Route::get('emails/getEmailSettingValue',[EmailController::class, 'getEmailSettingValue']);
    Route::apiResource('emails', EmailStatusController::class);

    Route::get('userroles/permissions', [UserRoleController::class, 'permissions'])->name('userroles.permissions');
    Route::apiResource('userroles', UserRoleController::class);
    Route::post('userroles/remove',[UserRoleController::class, 'deleteData']);
    Route::get('userroles/change-logs/{id}',[UserRoleController::class, 'getChangeLogs']);
    
    
    Route::get('schedulers/job-strings',[SchedulerController::class, 'getJobStrings']);
    Route::apiResource('schedulers', SchedulerController::class);
    Route::post('schedulers/remove',[SchedulerController::class, 'deleteData']);
    

    Route::get('administration/system-values',[SystemSettingController::class, 'getSystemSettingSettingValue']);
    Route::apiResource('administration/systemsettings', SystemSettingController::class);

    Route::get('administration/local-values',[LocalSettingController::class, 'getLocalSettingSettingValue']);
    Route::apiResource('administration/localsettings', LocalSettingController::class);



    Route::get('administration/pdf-values',[PdfSettingController::class, 'getPdfSettingSettingValue']);
    Route::apiResource('administration/pdfsettings', PdfSettingController::class);

   
    Route::apiResource('products', ProductController::class);
    Route::post('products/remove', [ProductController::class, 'remove']);
   
    Route::apiResource('bulkinventorys', ProductController::class);
    Route::post('bulkinventorys/remove', [ProductController::class, 'remove']);
    Route::post('bulkinventorys/uploads', [ProductController::class, 'bulkUploads']);

    Route::apiResource('categorys', CategoryController::class);
    Route::post('categorys/remove', [CategoryController::class, 'remove']);


    Route::apiResource('taxtypes', DashboardAdminTaxtypeController::class);
    Route::post('taxtypes/remove', [DashboardAdminTaxtypeController::class, 'remove']);
    Route::post('taxtypes/gettax', [DashboardAdminTaxtypeController::class, 'gettax']);
    
    Route::apiResource('subcategorys', SubCategoryController::class);
    Route::post('subcategorys/remove', [SubCategoryController::class, 'remove']);
    Route::post('subcategorys/getmenu', [SubCategoryController::class, 'getMenu']);
    Route::post('subcategorys/getdata', [SubCategoryController::class, 'subCategoryById']);

    Route::apiResource('clientmasters', ClientMasterController::class);
    Route::post('clientmasters/remove', [ClientMasterController::class, 'remove']);

    Route::apiResource('vendormasters', VendorMasterController::class);
    Route::post('vendormasters/remove', [VendorMasterController::class, 'remove']);

    Route::apiResource('purchases', PurchaseController::class);
    Route::post('purchases/remove', [PurchaseController::class, 'remove']);

    Route::apiResource('quotations', QuotationController::class);
    Route::post('quotations/remove', [QuotationController::class, 'remove']);

    Route::apiResource('deliverychallans', DeliveryChallanController::class);
    Route::post('deliverychallans/remove', [DeliveryChallanController::class, 'remove']);
    Route::post('del_delivery', [DeliveryChallanController::class, 'removeItem']);
    Route::post('deliverychallans/updateitem', [DeliveryChallanController::class, 'updateDelivery']);
    Route::post('deliverychallans/updatedelivery', [DeliveryChallanController::class, 'updateDeliveryData']);

    Route::apiResource('orders', VendorMasterController::class);
    Route::post('orders/remove', [VendorMasterController::class, 'remove']);

    Route::apiResource('branchs', BranchController::class);
    Route::post('branchs/remove', [BranchController::class, 'deleteData']);
    Route::post('branchs/getdata', [BranchController::class, 'subBranchById']);
    Route::post('branchs/getBranch', [BranchController::class, 'getActiveBranch']);


    Route::apiResource('examples', ExampleController::class);
    Route::post('examples/remove', [ExampleController::class, 'deleteData']);
    Route::get('examples/change-logs/{id}',[ExampleController::class, 'getChangeLogs']);

    Route::apiResource('countrylists', CountryListController::class);
    Route::post('countrylists/remove', [CountryListController::class, 'deleteData']);

    Route::apiResource('statelists', StateListController::class);
    Route::post('statelists/remove', [StateListController::class, 'deleteData']);
    
    Route::get('account/show', [AccountController::class, 'show']);
    Route::post('account/update', [AccountController::class, 'update']);
    Route::post('account/password', [AccountController::class, 'updatePassword']);
    Route::apiResource('account', AccountController::class);
   /*  Route::post('accounts/remove', [BranchController::class, 'remove']);
    Route::post('accounts/getdata', [BranchController::class, 'subBranchById']);
    Route::post('accounts/getBranch', [BranchController::class, 'getActiveBranch']); */
    
    
    Route::apiResource('userdashlets', UserDashletController::class);
    Route::post('userdashlets/remove', [UserDashletController::class, 'remove']);
    
    Route::get('administration/unique', [SequenceController::class, 'index']);
    Route::post('/administration/getglobal',[GlobalSettingController::class, 'getGlobal']);
    Route::post('/administration/updateglobal',[GlobalSettingController::class, 'updateGlobal']);
    Route::post('administration/resetglobal',[GlobalSettingController::class, 'resetGlobal']);
    Route::get('sequences', [SequenceController::class, 'index']);
    Route::post('sequences/saveSequence', [SequenceController::class, 'store']);
    Route::post('sequences/getSequence', [SequenceController::class, 'getData']);
    Route::post('sequences/updateSequence', [SequenceController::class, 'update']);
    Route::post('sequences/remove', [SequenceController::class, 'remove']);

    Route::get('settings/user-roles', [DashboardAdminSettingController::class, 'userRoles'])->name('settings.user-roles');
    Route::get('settings/languages', [DashboardAdminSettingController::class, 'languages'])->name('settings.languages');
    Route::get('settings/general', [DashboardAdminSettingController::class, 'getGeneral'])->name('settings.get.general');
    Route::post('settings/general', [DashboardAdminSettingController::class, 'setGeneral'])->name('settings.set.general');
    Route::get('settings/seo', [DashboardAdminSettingController::class, 'getSeo'])->name('settings.get.seo');
    Route::post('settings/seo', [DashboardAdminSettingController::class, 'setSeo'])->name('settings.set.seo');
    Route::get('settings/appearance', [DashboardAdminSettingController::class, 'getAppearance'])->name('settings.get.appearance');
    Route::post('settings/appearance', [DashboardAdminSettingController::class, 'setAppearance'])->name('settings.set.appearance');
    Route::get('settings/localization', [DashboardAdminSettingController::class, 'getLocalization'])->name('settings.get.localization');
    Route::post('settings/localization', [DashboardAdminSettingController::class, 'setLocalization'])->name('settings.set.localization');
    Route::get('settings/authentication', [DashboardAdminSettingController::class, 'getAuthentication'])->name('settings.get.authentication');
    Route::post('settings/authentication', [DashboardAdminSettingController::class, 'setAuthentication'])->name('settings.set.authentication');
    Route::get('settings/outgoing-mail', [DashboardAdminSettingController::class, 'getOutgoingMail'])->name('settings.get.outgoingMail');
    Route::post('settings/outgoing-mail', [DashboardAdminSettingController::class, 'setOutgoingMail'])->name('settings.set.outgoingMail');
    Route::get('settings/logging', [DashboardAdminSettingController::class, 'getLogging'])->name('settings.get.logging');
    Route::post('settings/logging', [DashboardAdminSettingController::class, 'setLogging'])->name('settings.set.logging');
    
    Route::post('invoices/deliverytoinvoice', [DeliveryChallanController::class, 'copyToInvoice']);
    Route::apiResource('invoices', InvoiceController::class);
    Route::post('invoices/remove', [InvoiceController::class, 'remove']);
    Route::post('del_invoice', [InvoiceController::class, 'removeItem']);
    Route::post('invoices/updateitem', [InvoiceController::class, 'updateInvoice']);
    Route::post('invoices/updateinvoice', [InvoiceController::class, 'updateInvoiceData']);
    Route::post('invoices/paymentstatus', [InvoiceController::class, 'CheckInvoicePayment']);
    Route::post('invoices/getdetails', [InvoiceController::class, 'getInvoiceDetail']);

    Route::post('payments/updateinvoicepayment', [PaymentController::class, 'updateInvoicePayment']);

    Route::post('languages/sync', [DashboardAdminLanguageController::class, 'sync'])->name('language.sync');
    Route::apiResource('languages', DashboardAdminLanguageController::class);

    Route::post('searchItem',[SearchController::class, 'searchItem']);
    
});
});