<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Admin\EventController;
use App\Http\Controllers\Api\User\EventController as UserEventController;
use App\Http\Controllers\Api\User\OrderTiket;
use App\Http\Controllers\Api\Admin\PelangganController;
use App\Http\Controllers\Api\Admin\ListTiketController;
use App\Http\Controllers\Api\User\BayarController;
use App\Http\Controllers\Api\Admin\DetailAdminController;
use App\Http\Controllers\Api\User\DetailUserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//For Auth
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

//Group
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::prefix('admin')->group(function (){
    Route::resource('event', EventController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('listtiket', OrderTiket::class);
    Route::resource('listtiket', ListTiketController::class);
});
    Route::post('pesan', [OrderTiket::class, 'store']);
    Route::put('pesan', [OrderTiket::class, 'update']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('bayar', [BayarController::class, 'store']);
    Route::get('statusbayar', [BayarController::class, 'index']);
    Route::get('detailadmin', [DetailAdminController::class, 'index']);
    Route::get('detailuser', [DetailUserController::class, 'index']);
   
    
});

//For event
Route::get('event', [UserEventController::class, 'index']);
Route::get('event/{id}', [UserEventController::class, 'show']);





