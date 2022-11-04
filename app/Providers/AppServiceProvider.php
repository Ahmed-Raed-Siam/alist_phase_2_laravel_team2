<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        JsonResource::withoutWrapping();
        // Validator::extend(
        //     'cart_number',
        //     function ($attribute, $value, $parameters, $validator) {
        //         if ($this->getCartinfo() > 0) {
        //             return true;
        //         }

        //         return false;
        //     },
        //     'الرجاء أضافة منتج على الأقل'
        // );
    }

    protected function getCartinfo()
    {
        $cart = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $itemsNum = count($cart);

        return $itemsNum;
    }
}
