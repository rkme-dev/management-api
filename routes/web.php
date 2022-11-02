<?php

use App\Http\Controllers\PurchaseOrderBarcodePrintController;
use App\Http\Controllers\PurchaseOrderPrintController;
use App\Http\Controllers\SalesOrder\SalesOrderCollectionReceiptController;
use App\Http\Controllers\SalesOrder\SalesOrderDeliveryReceiptController;
use App\Http\Controllers\SalesOrder\SalesOrderPrintController;
use App\Http\Controllers\Logistics\TripTicketsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('print-purchase-order/{id}', [
    'as' => 'print.purchase-order',
    'uses' => PurchaseOrderPrintController::class
]);

Route::get('print-purchase-order-barcode/{id}', [
    'as' => 'print.purchase-order.barcode',
    'uses' => PurchaseOrderBarcodePrintController::class
]);

Route::get('print-sales-order/{id}', [
    'as' => 'print.sales-order',
    'uses' => SalesOrderPrintController::class
]);

Route::get('print-so-delivery-receipt/{id}', [
    'as' => 'print.sales-order.delivery-receipt',
    'uses' => SalesOrderDeliveryReceiptController::class
]);

Route::get('print-so-collection-receipt/{id}', [
    'as' => 'print.sales-order.collection-receipt',
    'uses' => SalesOrderCollectionReceiptController::class
]);

Route::get('print-trip-ticket/{id}', [
    'as' => 'print.logistics.trip-ticket',
    'uses' => TripTicketsController::class
]);

Route::get('/', function () {
    return [
        "data" => [
            "message" => "enco-api",
            "code" => 200,
            "error" => false,
        ],
    ];
});
