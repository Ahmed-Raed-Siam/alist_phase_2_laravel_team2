<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Models\DeliveryDrivers;
use App\Models\OrderCases;
use Illuminate\Http\Request;

class DeliveryDriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivery_drivers = DeliveryDrivers::get();

        return response()->json(['code' => 200
                                , 'status' => true,
                                'delivery_drivers' => $delivery_drivers]);
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

        return response()->json(['code' => 200
                                , 'status' => true,
                                'delivery_drivers' => $delivery_drivers]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($driver)
    {
        $delivery_drivers = DeliveryDrivers::findOrFail($driver);

        return response()->json(['code' => 200
                                , 'status' => true,
                                'delivery_drivers' => $delivery_drivers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $driver)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ],[
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب ان يكون نص',
            'name.max' => 'الاسم يجب ان لا يزيد عن 255 حرف',
        ]);

        $delivery_drivers = DeliveryDrivers::findOrFail($driver);
        $delivery_drivers->update($request->all());


        return response()->json(['code' => 200
                                , 'status' => true,
                                'delivery_drivers' => $delivery_drivers]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($driver)
    {
        $delivery_drivers = DeliveryDrivers::findOrFail($driver)->delete();

        return response()->json(['code' => 200
                                , 'status' => true,
                                'message' => 'تمت العمليه بنجاح!!']);
    }
}
