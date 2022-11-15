<?php

namespace App\Observers;

use App\Exceptions\FewPointException;
use App\Models\CustomerManagment;
use App\Models\PointsTransfer;

use function PHPUnit\Framework\throwException;

class PointsTransferObserver
{

    public function creating(PointsTransfer $pointsTransfer)
    {


        $from = CustomerManagment::find($pointsTransfer->from);
        $to = CustomerManagment::where('mobile' , $pointsTransfer->to)->first();
        $pointsTransfer->to = $to->id ;

        if($from->total_point < $pointsTransfer->points_number ){
            throw new FewPointException();
            response()->json(['message' => 'عملية خاطئة'], 400);

        }else{

            $from->update(['total_point' => ($from->total_point - $pointsTransfer->points_number) ]);
            $to->update(['total_point' => ($to->total_point + $pointsTransfer->points_number )]);
        }


    }
    /**
     * Handle the PointsTransfer "created" event.
     *
     * @param  \App\Models\PointsTransfer  $pointsTransfer
     * @return void
     */
    public function created(PointsTransfer $pointsTransfer)
    {
        //

    }

    /**
     * Handle the PointsTransfer "updated" event.
     *
     * @param  \App\Models\PointsTransfer  $pointsTransfer
     * @return void
     */
    public function updated(PointsTransfer $pointsTransfer)
    {
        //
    }

    /**
     * Handle the PointsTransfer "deleted" event.
     *
     * @param  \App\Models\PointsTransfer  $pointsTransfer
     * @return void
     */
    public function deleted(PointsTransfer $pointsTransfer)
    {
        //
        $from = CustomerManagment::find($pointsTransfer->from);
        $to = CustomerManagment::find($pointsTransfer->to);

        // if($from->total_point < $pointsTransfer->points_number ){
        //     throw new FewPointException();
        //     response()->json(['message' => 'عملية خاطئة'], 400);

        // }else{

            $from->update(['total_point' => ($from->total_point + $pointsTransfer->points_number) ]);
            $to->update(['total_point' => ($to->total_point - $pointsTransfer->points_number )]);
        // }

    }

    /**
     * Handle the PointsTransfer "restored" event.
     *
     * @param  \App\Models\PointsTransfer  $pointsTransfer
     * @return void
     */
    public function restored(PointsTransfer $pointsTransfer)
    {
        //
    }

    /**
     * Handle the PointsTransfer "force deleted" event.
     *
     * @param  \App\Models\PointsTransfer  $pointsTransfer
     * @return void
     */
    public function forceDeleted(PointsTransfer $pointsTransfer)
    {
        //
    }
}
