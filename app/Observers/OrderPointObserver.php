<?php

namespace App\Observers;

use App\Models\CustomerManagment;
use App\Models\OrderPoint;

class OrderPointObserver
{
    /**
     * Handle the OrderPoint "created" event.
     *
     * @param  \App\Models\OrderPoint  $orderPoint
     * @return void
     */
    public function created(OrderPoint $orderPoint)
    {
        //

    }

    /**
     * Handle the OrderPoint "updated" event.
     *
     * @param  \App\Models\OrderPoint  $orderPoint
     * @return void
     */
    public function updated(OrderPoint $orderPoint)
    {
        //
    }

    /**
     * Handle the OrderPoint "deleted" event.
     *
     * @param  \App\Models\OrderPoint  $orderPoint
     * @return void
     */
    public function deleted(OrderPoint $orderPoint)
    {
        //
    }

    /**
     * Handle the OrderPoint "restored" event.
     *
     * @param  \App\Models\OrderPoint  $orderPoint
     * @return void
     */
    public function restored(OrderPoint $orderPoint)
    {
        //
    }

    /**
     * Handle the OrderPoint "force deleted" event.
     *
     * @param  \App\Models\OrderPoint  $orderPoint
     * @return void
     */
    public function forceDeleted(OrderPoint $orderPoint)
    {
        //
    }
}
