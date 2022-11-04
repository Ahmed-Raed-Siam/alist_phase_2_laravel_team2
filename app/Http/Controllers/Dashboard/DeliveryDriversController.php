<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DeliveryDrivers;
use App\Models\OrderCases;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DeliveryDriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $delivery_drivers = DeliveryDrivers::all();

        if ($request->ajax()) {

            return datatables()->of($delivery_drivers)
                ->addcolumn('actions', function (DeliveryDrivers $delivery_drivers) {
                    $edit = '<a href="javascript:void(0);"  class="dropdown-item editRecord" data-toggle= "modal" data-id= "' . $delivery_drivers->id . '" title="تعديل "><i class="ti-pencil-alt"></i>تعديل</a>';

                    $delete = '<a href="javascript:void(0);" class="dropdown-item deleteRecord" data-toggle= "modal" id= "' . $delivery_drivers->id . '" title="حذف "><i class="ti-trash"></i>حذف</a>';

                    $button = '<div class="btn-group">
                                                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ti-settings"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                                                                        '. $edit . $delete  .'
                                                                    </div>
                                                                </div>';
                    return $button;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.delivery_drivers.index', [
            'location_title' => 'السائقين',
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ],[
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب ان يكون نص',
            'name.max' => 'الاسم يجب ان لا يزيد عن 255 حرف',
        ]);

        $delivery_drivers = DeliveryDrivers::create($request->all());
        if (!empty($delivery_drivers)) {
            return response()->json([
                'success' => true,
                'delivery_drivers_id' => $delivery_drivers->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'delivery_drivers_id' => $delivery_drivers->id,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryDrivers  $DeliveryDrivers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return DeliveryDrivers::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryDrivers  $DeliveryDrivers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ],[
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب ان يكون نص',
            'name.max' => 'الاسم يجب ان لا يزيد عن 255 حرف',
        ]);

        $delivery_drivers = DeliveryDrivers::findorFail($id);
        $delivery_drivers->update($request->all());
        if (!empty($delivery_drivers)) {
            return response()->json([
                'success' => true,
                'delivery_drivers_id' => $delivery_drivers->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'delivery_drivers_id' => $delivery_drivers->id,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryDrivers  $DeliveryDrivers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delivery_drivers = DeliveryDrivers::findorFail($id);
        $delivery_drivers->delete();

    }
    public function destroyAll(Request $request)
    {
        $delivery_drivers_id_array = $request->input('id');
        $delivery_drivers = DeliveryDrivers::whereIn('id', $delivery_drivers_id_array);
        $delivery_drivers->delete();

    }
}
