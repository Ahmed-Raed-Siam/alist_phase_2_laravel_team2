<?php

use App\Http\Controllers\PointsTransferController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\CustomerManagmentController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\OrderCasesController;
use App\Http\Controllers\Dashboard\DeliveryDriversController;
use App\Http\Controllers\Dashboard\ReportsController;
use App\Http\Controllers\Dashboard\AdController;
use App\Http\Controllers\Dashboard\CartController;
use App\Http\Controllers\Dashboard\DeliveryManagementController;
use App\Http\Controllers\Dashboard\OrdersProductController;
use App\Http\Controllers\Dashboard\settings\SettingController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\PointManagementController;
use App\Http\Controllers\Dashboard\TransportController;
use App\Http\Controllers\OrderPointController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')
    ->middleware('guest:admin')
    ->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name(
            'auth.login-show'
        );
        Route::post('login', [AuthController::class, 'login'])->name(
            'auth.login'
        );
    });

Route::prefix('dashboard')
    ->middleware('auth:admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name(
            'dashboard.index'
        );

        Route::get('OrderChart', [DashboardController::class, 'orderChart'])->name(
            'dashboard.OrderChart'
        );

        //////////// USER Route//////////////

        Route::resource('users', UserController::class);

        //////////// USER Profile//////////////
        Route::get('logout', [AuthController::class, 'logout'])->name(
            'auth.logout'
        );

        /////////////Route categories ///////////
        Route::resource('categories', CategoriesController::class);
        Route::delete('categories-delete-all', [
            CategoriesController::class,
            'deleteAll',
        ]);

        /////////////Route reports ///////////
        Route::resource('reports', ReportsController::class);
        Route::delete('reports-delete-all', [
            ReportsController::class,
            'deleteAll',
        ]);

        /////////////Route Prodect ///////////

        Route::resource('products', ProductController::class)->except('show');
        Route::get('getProduct', [ProductController::class, 'getProduct']);
        /////////////Delete All Select Product///////
        Route::delete('productsDeleteAll', [ProductController::class, 'deleteAll']);
        /////////////Show All Delete Product///////
        Route::get('show-Delete-Product', [ProductController::class, 'indexDeleteProduct'])->name('showDeleletProduct');
        /////////////Restore One Product///////
        Route::get('product/restore/one/{id}', [ProductController::class, 'restoreProduct'])->name('restoreProdect');
        /////////////Restore All Product///////
        Route::get('restoreAllProudect', [ProductController::class, 'restoreAllProduct'])->name('restoreAllProudect');




        ///////////Orders Routes////////

        //  cart routes
        Route::get('cart', [CartController::class, 'index'])->name('cart');
        Route::post('cart', [CartController::class, 'store'])->name(
            'cart.store'
        );
        Route::post('cart-update', [CartController::class, 'update'])->name(
            'cart.update'
        );
        Route::get('cart-delete', [CartController::class, 'destroyAll'])->name(
            'cart.deleteAll'
        );
        Route::get('cart/{id}/show', [CartController::class, 'show'])->name(
            'cart.show'
        );
        Route::delete('cart/{id}', [CartController::class, 'destroy'])->name(
            'cart.destroy'
        );

        Route::get('products-cart', [CartController::class, 'products'])->name(
            'products-cart'
        );
        //  order product route
        Route::get('orders-product/driver', [
            OrdersProductController::class,
            'driver',
        ]);
        Route::get('orders-product/status', [
            OrdersProductController::class,
            'status',
        ]);
        Route::get('orders-product/{id}/order-copy', [
            OrdersProductController::class,
            'copy',
        ]);
        Route::get('orders-product/delete-selected', [
            OrdersProductController::class,
            'destroyAll',
        ])->name('orders-product-destroyAll');
        Route::get('orders-product/deliver-selected', [
            OrdersProductController::class,
            'deliverAll',
        ])->name('orders-product-deliverAll');
        Route::resource('orders-product', OrdersProductController::class);
        Route::post('order-product-update', [
            OrdersProductController::class,
            'productUpdate',
        ])->name('order.product.update');
        Route::get('order-product-add', [
            OrdersProductController::class,
            'productAdd',
        ])->name('order-product-add');
        Route::get('order-product-delete', [
            OrdersProductController::class,
            'productDelete',
        ])->name('order.product.delete');

        //  order route
        Route::get('orders/driver', [OrdersController::class, 'driver']);
        Route::get('orders/status', [OrdersController::class, 'status']);
        Route::get('orders/{id}/order-copy', [OrdersController::class, 'copy']);
        Route::get('orders/delete-selected', [
            OrdersController::class,
            'destroyAll',
        ])->name('orders-destroyAll');
        Route::get('orders/deliver-selected', [
            OrdersController::class,
            'deliverAll',
        ])->name('orders-deliverAll');

        Route::resource('orders', OrdersController::class);

        //  order cases route
        Route::get('order-cases/delete-selected', [
            OrderCasesController::class,
            'destroyAll',
        ])->name('order-cases-destroyAll');
        Route::resource('order-cases', OrderCasesController::class);

        //  delivery drivers route
        Route::get('delivery-drivers/delete-selected', [
            DeliveryDriversController::class,
            'destroyAll',
        ])->name('delivery-drivers-destroyAll');
        Route::resource('delivery-drivers', DeliveryDriversController::class);

        //   ******* Start Term & Conditions *******

        // Route::resource('terms', TermController::class)->except('show');

        //    ******** End Term & Conditions ********

        //   ******* Start settings *******

        Route::resource('settings', SettingController::class)->except('show');

        //    ******** End settings ********

        # Start Transport Veichle Managment

        Route::resource('transport', TransportController::class);

        Route::resource('ads', AdController::class);

        # Start Customer Managment

        Route::resource('customer', CustomerManagmentController::class);

        Route::resource('delivery', DeliveryManagementController::class);
        Route::put('delivery-update-many/{status}', [
            DeliveryManagementController::class,
            'updateMany',
        ]);
        Route::delete('delivery-delete-many', [
            DeliveryManagementController::class,
            'deleteMany',
        ]);
        Route::delete('transfer-delete-many', [
            PointsTransferController::class,
            'deleteMany',
        ]);

        Route::resource('points-management', PointManagementController::class);
        Route::resource('points-transfer', PointsTransferController::class);
        Route::resource('order-points', OrderPointController::class);
    });

/*
Route::prefix('dashboard')->middleware('guest:admin')->group(function () {

    Route::get('login', [AuthController::class, 'showLogin'])->name('auth.login-show');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});

Route::prefix('dashboard')->middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    //////////// USER Route//////////////

    Route::resource('users', UserController::class);

    //////////// USER Profile//////////////
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    ;

    /////////////Route categories ///////////
    Route::resource('categories', CategoriesController::class);
    Route::delete('categories-delete-all', [CategoriesController::class, 'deleteAll']);

    /////////////Route reports ///////////
    Route::resource('reports', ReportsController::class);
    Route::delete('reports-delete-all', [ReportsController::class, 'deleteAll']);

    /////////////Route Prodect ///////////

    Route::resource('products', ProductController::class)->except('show');
    Route::get('getProduct', [ProductController::class, 'getProduct']);
    /////////////Delete All Select Product///////
    Route::delete('productsDeleteAll', [ProductController::class, 'deleteAll']);
    /////////////Show All Delete Product///////
    Route::get('show-Delete-Product', [ProductController::class, 'indexDeleteProduct'])->name('showDeleletProduct');
    /////////////Restore One Product///////
    Route::get('product/restore/one/{id}', [ProductController::class, 'restoreProduct'])->name('restoreProdect');
    /////////////Restore All Product///////
    Route::get('restoreAllProudect', [ProductController::class, 'restoreAllProduct'])->name('restoreAllProudect');


    ///////////Orders Routes////////

    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('cart-update', [CartController::class, 'update'])->name('cart.update');
    Route::get('cart-delete', [CartController::class, 'destroyAll'])->name('cart.deleteAll');
    Route::get('cart/{id}/show', [CartController::class, 'show'])->name('cart.show');
    Route::delete('cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('products-cart', [CartController::class, 'products'])->name('products-cart');


    Route::get('orders-product/driver', [OrdersProductController::class, 'driver']);
    Route::get('orders-product/status', [OrdersProductController::class, 'status']);
    Route::get('orders-product/{id}/order-copy', [OrdersProductController::class, 'copy']);
    Route::get('orders-product/delete-selected', [OrdersProductController::class, 'destroyAll'])->name('orders-product-destroyAll');
    Route::resource('orders-product', OrdersProductController::class);
    Route::post('order-product-update', [OrdersProductController::class, 'productUpdate'])->name('order.product.update');

    Route::get('orders/driver', [OrdersController::class, 'driver']);
    Route::get('orders/status', [OrdersController::class, 'status']);
    Route::get('orders/{id}/order-copy', [OrdersController::class, 'copy']);
    Route::get('orders/delete-selected', [OrdersController::class, 'destroyAll'])->name('orders-destroyAll');
    Route::resource('orders', OrdersController::class);

    Route::get('order-cases/delete-selected', [OrderCasesController::class, 'destroyAll'])->name('order-cases-destroyAll');
    Route::resource('order-cases', OrderCasesController::class);


    Route::get('delivery-drivers/delete-selected', [DeliveryDriversController::class, 'destroyAll'])->name('delivery-drivers-destroyAll');
    Route::resource('delivery-drivers', DeliveryDriversController::class);

    //   ******* Start Term & Conditions *******

    Route::resource('terms', TermController::class)->except('show');

    //    ******** End Term & Conditions ********
};
*/
