<?php

use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\ReceiptEntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('update-delivery-status',[ReceiptEntryController::class,'updateDeliveryStatus']);
Route::post('purchase-order/update-header',[PurchaseOrderController::class,'updateHeader']);
Route::post('purchase-order/update-detail',[PurchaseOrderController::class,'updateDetail']);
