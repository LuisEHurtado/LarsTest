<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Products;
use App\Models\Orders;
use App\Observers\ProductsObserver;
use App\Observers\OrdersObserver;
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
        Products::observe(ProductsObserver::class);
        Orders::observe(OrdersObserver::class);
    }
}
