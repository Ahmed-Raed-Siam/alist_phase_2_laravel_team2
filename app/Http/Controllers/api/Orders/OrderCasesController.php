<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Models\OrderCases;
use Illuminate\Http\Request;

class OrderCasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderCases = OrderCases::get();

        return response()->json(['code' => 200
                                , 'status' => true,
                                'order_cases' => $orderCases]);
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

        $order_case = OrderCases::create($request->all());

        return response()->json(['code' => 200
                                , 'status' => true,
                                'order_case' => $order_case]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($case)
    {
        $order_case = OrderCases::findOrFail($case);
        if(!$order_case){
            return response()->json([
                'success' => false,
                'message' => 'لا يوجد',
            ]);
        }
        return response()->json(['code' => 200
                                , 'status' => true,
                                'order_case' => $order_case]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $case)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ],[
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب ان يكون نص',
            'name.max' => 'الاسم يجب ان لا يزيد عن 255 حرف',
        ]);

        $order_case = OrderCases::findOrFail($case);
        $order_case->update($request->all());


        return response()->json(['code' => 200
                                , 'status' => true,
                                'order_case' => $order_case]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($case)
    {
        $order_case = OrderCases::findOrFail($case)->delete();
        if(!$order_case){
            return response()->json([
                'success' => false,
                'message' => 'لا يوجد',
            ]);
        }
        return response()->json(['code' => 200
                                , 'status' => true,
                                'message' => 'تمت العمليه بنجاح!!']);
    }
}
