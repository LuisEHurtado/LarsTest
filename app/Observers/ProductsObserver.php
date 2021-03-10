<?php

namespace App\Observers;

use App\Models\Products;
use App\Models\Logs;
use Auth;

class ProductsObserver
{
    /**
     * Handle the Products "created" event.
     *
     * @param  \App\Models\Products  $products
     * @return void
     */
    public function created(Products $products)
    {
        $logs=Logs::create([
            'type'=>'Creando  producto #'.$products->id. '-'. $products->name,
            'user_id'=>Auth::user()->id,
        ]);
    }

    /**
     * Handle the Products "updated" event.
     *
     * @param  \App\Models\Products  $products
     * @return void
     */
    public function updated(Products $products)
    {
        $logs=Logs::create([
            'type'=>'Actualización del producto #'.$products->id. '-'. $products->name,
            'user_id'=>Auth::user()->id,
        ]);
    }

    /**
     * Handle the Products "deleted" event.
     *
     * @param  \App\Models\Products  $products
     * @return void
     */
    public function deleted(Products $products)
    {
        $logs=Logs::create([
            'type'=>'Eliminando  producto #'.$products->id. '-'. $products->name,
            'user_id'=>Auth::user()->id,
        ]);
    }

    /**
     * Handle the Products "restored" event.
     *
     * @param  \App\Models\Products  $products
     * @return void
     */
    public function restored(Products $products)
    {
        //
    }

    /**
     * Handle the Products "force deleted" event.
     *
     * @param  \App\Models\Products  $products
     * @return void
     */
    public function forceDeleted(Products $products)
    {
        //
    }
}
