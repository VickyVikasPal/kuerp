<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppController as AppController;


use App\Modules\Quotations\Pdf\HealQuotation as HealQuotation;
use App\Modules\DeliveryChallans\Pdf\HealDeliveryChallan as HealDeliveryChallan;
use App\Modules\Invoices\Pdf\HealInvoice as HealInvoice;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| composer require barryvdh/laravel-dompdf
*/




//Route::middleware(['auth'])->group(function () {    
    Route::get('quotations/generate-pdf/{id}', [HealQuotation::class, 'Display']);
    Route::get('deliverychallans/generate-pdf/{id}', [HealDeliveryChallan::class, 'Display']);
    Route::get('invoices/generate-pdf/{id}', [HealInvoice::class, 'Display']);
//});


Route::get('{all}', [AppController::class, 'index'])->where('all', '^((?!api).)*')->name('index');

/*Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

?>