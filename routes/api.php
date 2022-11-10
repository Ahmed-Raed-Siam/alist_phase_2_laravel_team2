<?php

use App\Http\Controllers\api\AuthController;
// use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Categories\CategoriesController;
use App\Http\Controllers\api\CustomerMangmentController;
use App\Http\Controllers\api\ProdectController;
use App\Http\Controllers\api\Orders\OrdersController;
use App\Http\Controllers\api\Orders\OrderCasesController;
use App\Http\Controllers\api\Orders\DeliveryDriversController;
use App\Http\Controllers\api\Reports\ReportsController;
use App\Http\Controllers\api\Orders\CartController;
use App\Http\Controllers\api\Orders\OrdersProductController;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\Setting\SettingController;
use App\Http\Controllers\api\Transports\TransportController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [AuthController::class, 'login']);

Route::post('register', [AuthController::class, 'register']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
Route::post('rest-password', [AuthController::class, 'resetPassword']);

Route::get('logout', [AuthController::class, 'logout']);

///// Route categories ///////


//*******USER PROFILE**** */
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('profile-update', [ProfileController::class, 'update'])->name('profile.update');


Route::get('categories', [CategoriesController::class, 'index']);
Route::get('main/{id}', [CategoriesController::class, 'indexmain']);
Route::get('search-category', [CategoriesController::class, 'search']);
Route::get('{id}/show-category', [CategoriesController::class, 'show']);
Route::get('{id}/show-category-main', [CategoriesController::class, 'showmain']);
Route::post('create-category', [CategoriesController::class, 'store']);
Route::post('create-main/category', [CategoriesController::class, 'storemain']);
Route::post('{id}/update-category', [CategoriesController::class, 'update']);
Route::post('{id}/update-category-main', [CategoriesController::class, 'updatemain']);
Route::post('{id}/delete-category', [CategoriesController::class, 'destroy']);
Route::post('{id}/delete-category-main', [CategoriesController::class, 'destroymain']);

///// Route report ///////
Route::get('report', [ReportsController::class, 'index']);
Route::get('search-report', [ReportsController::class, 'search']);
Route::get('{id}/show-report', [ReportsController::class, 'show']);
Route::post('create-report', [ReportsController::class, 'store']);
Route::post('{id}/update-report', [ReportsController::class, 'update']);
Route::post('{id}/delete-report', [ReportsController::class, 'destroy']);





// Route::resource('products', ProdectController::class);

//   ******* Start Term & Conditions *******

Route::get('terms', [SettingController::class, 'index']);

//    ******** End Term & Conditions ********

////***** Order Api ****////
Route::middleware('auth:sanctum')->group(function () {

    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart', [CartController::class, 'store']);
    Route::delete('cart/{cart}', [CartController::class, 'destroy']);
    Route::post('cart-update', [CartController::class, 'update']);
    Route::delete('cart-delete',  [CartController::class, 'destroyAll']);

    Route::get('orders-product', [OrdersProductController::class, 'index']);
    Route::post('orders-product', [OrdersProductController::class, 'store']);
    Route::post('order-product-update', [OrdersProductController::class, 'productUpdate']);
    Route::post('order-product-add', [OrdersProductController::class, 'productAdd']);
    Route::delete('order-product-delete', [OrdersProductController::class, 'productDelete']);
    Route::put('orders-product/{order}', [OrdersProductController::class, 'update']);
    Route::get('orders-product/{order}', [OrdersProductController::class, 'show']);
    Route::delete('orders-product/{order}', [OrdersProductController::class, 'destroy']);

    Route::get('orders', [OrdersController::class, 'index']);
    Route::post('orders', [OrdersController::class, 'store']);
    Route::put('orders/{order}', [OrdersController::class, 'update']);
    Route::get('orders/{order}', [OrdersController::class, 'show']);
    Route::delete('orders/{order}', [OrdersController::class, 'destroy']);


    Route::get('order-cases', [OrderCasesController::class, 'index']);
    Route::post('order-cases', [OrderCasesController::class, 'store']);
    Route::put('order-cases/{case}', [OrderCasesController::class, 'update']);
    Route::get('order-cases/{case}', [OrderCasesController::class, 'show']);
    Route::delete('order-cases/{case}', [OrderCasesController::class, 'destroy']);

    ///// Route Api Product ///////

  Route::get('products', [ProdectController::class, 'index']);
Route::post('/products', [ProdectController::class, 'store']);
Route::get('products/{id}', [ProdectController::class, 'show']);
Route::post('products/{id}', [ProdectController::class, 'update']);
Route::delete('products/{id}',  [ProdectController::class, 'destroy']);

    Route::get('delivery-drivers', [DeliveryDriversController::class, 'index']);
    Route::post('delivery-drivers', [DeliveryDriversController::class, 'store']);
    Route::put('delivery-drivers/{driver}', [DeliveryDriversController::class, 'update']);
    Route::get('delivery-drivers/{driver}', [DeliveryDriversController::class, 'show']);
    Route::delete('delivery-drivers/{driver}', [DeliveryDriversController::class, 'destroy']);


    #Start Transport Vehicle Managment

    Route::get('transport',[TransportController::class , 'getTransport']);
    Route::post('transport',[TransportController::class , 'storeTransport']);
    Route::put('transport/{transport}/update',[TransportController::class , 'updateTransport']);
    Route::delete('transport/{transport}',[TransportController::class , 'destroy']);


    #Start Customer Management

    Route::get('customer-management',[CustomerMangmentController::class , 'getCustomer']);
    Route::post('customer-management',[CustomerMangmentController::class , 'storeCustomer']);
    Route::put('customer-management/{customerManagment}/update',[CustomerMangmentController::class , 'updateCustomer']);
    Route::delete('customer-management/{customerManagment}',[CustomerMangmentController::class , 'destroy']);
});





