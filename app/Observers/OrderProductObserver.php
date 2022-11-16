<?php

namespace App\Observers;

use App\Models\CustomerManagment;
use App\Models\OrderPoint;
use App\Models\OrdersProduct;

class OrderProductObserver
{
    /**
     * Handle the OrdersProduct "created" event.
     *
     * @param  \App\Models\OrdersProduct  $ordersProduct
     * @return void
     */
    public function created(OrdersProduct $ordersProduct)
    {
        //
        if($ordersProduct->customer_id){
        $points = ceil( $ordersProduct->total * 0.1);
        OrderPoint::create([
            'order_id' => $ordersProduct->id ,
            'customer_id' => $ordersProduct->customer_id,
            'points_number' =>  $points
         ]);


         $customer = CustomerManagment::where('id' , $ordersProduct->customer_id )->first();

          $customer->update(['total_point' => $customer->total_point +  $points ]);
        }


    }

    /**
     * Handle the OrdersProduct "updated" event.
     *
     * @param  \App\Models\OrdersProduct  $ordersProduct
     * @return void
     */
    public function updated(OrdersProduct $ordersProduct)
    {
        //

        if($ordersProduct->customer_id && !OrderPoint::where('order_id' ,$ordersProduct->id)->first()){
            $points = ceil( $ordersProduct->total * 0.1);
            OrderPoint::create([
                'order_id' => $ordersProduct->id ,
                'customer_id' => $ordersProduct->customer_id,
                'points_number' =>  $points
             ]);


             $customer = CustomerManagment::where('id' , $ordersProduct->customer_id )->first();

              $customer->update(['total_point' => $customer->total_point +  $points ]);
            }

    }

    /**
     * Handle the OrdersProduct "deleted" event.
     *
     * @param  \App\Models\OrdersProduct  $ordersProduct
     * @return void
     */
    public function deleted(OrdersProduct $ordersProduct)
    {
        //

        $order_points = OrderPoint::where('order_id' ,$ordersProduct->id )->first();
        if($order_points){
        $customer = CustomerManagment::where('id' , $ordersProduct->customer_id )->first();

        $customer->update(['total_point' => $customer->total_point - $order_points->point_numbers]);
    }

    }

    /**
     * Handle the OrdersProduct "restored" event.
     *
     * @param  \App\Models\OrdersProduct  $ordersProduct
     * @return void
     */
    public function restored(OrdersProduct $ordersProduct)
    {
        //
    }

    /**
     * Handle the OrdersProduct "force deleted" event.
     *
     * @param  \App\Models\OrdersProduct  $ordersProduct
     * @return void
     */
    public function forceDeleted(OrdersProduct $ordersProduct)
    {
        //
    }
}
