<?php

namespace App\Observers;

use App\Models\Orders;
use App\Models\Logs;
use Auth;
class OrdersObserver
{
    /**
     * Handle the Orders "created" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function created(Orders $orders)
    {
        $logs=Logs::create([
            'type'=>'Creando  orden #'.$orders->id,
            'user_id'=>Auth::user()->id,
        ]);
    }

    /**
     * Handle the Orders "updated" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function updated(Orders $orders)
    {
        $logs=Logs::create([
            'type'=>'Actualizando  orden #'.$orders->id,
            'user_id'=>Auth::user()->id,
        ]);
    }

    /**
     * Handle the Orders "deleted" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function deleted(Orders $orders)
    {
        $logs=Logs::create([
            'type'=>'Eliminando  orden #'.$orders->id,
            'user_id'=>Auth::user()->id,
        ]);
    }

    /**
     * Handle the Orders "restored" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function restored(Orders $orders)
    {
        //
    }

    /**
     * Handle the Orders "force deleted" event.
     *
     * @param  \App\Models\Orders  $orders
     * @return void
     */
    public function forceDeleted(Orders $orders)
    {
        //
    }
}
