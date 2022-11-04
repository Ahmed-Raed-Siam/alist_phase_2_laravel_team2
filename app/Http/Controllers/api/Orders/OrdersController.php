<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::with('cases','drivers','customers')->get();

        return response()->json(['code' => 200
                                , 'status' => true,
                                'orders' => $orders]);
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
            'order_number' => ['required', 'numeric', "unique:orders,order_number",'min:0'],
            'products_number' => ['required', 'numeric', 'min:0'],
            'customer_id' => ['required'],
            'total' => ['required', 'numeric', 'min:0'],
            'driver_id' => ['required'],
            'order_status_id' => ['required'],
            'evaluation'=> ['numeric','min:0' , 'max:5'],
        ],[
            'order_number.required' => 'رقم الطلب مطلوب',
            'order_number.numeric' => 'رقم الطلب يجب ان يكون رقم',
            'order_number.min' => 'رقم الطلب يجب ان يكون اكبر من 0',
            'order_number.unique' => 'رقم الطلب موجود يالفعل!!',

            'products_number.required' => 'عدد المنتجات مطلوب',
            'products_number.numeric' => 'عدد المنتجات يجب ان يكون رقم',
            'products_number.min' => 'عدد المنتجات يجب ان يكون اكبر من 0',

            'total.required' => 'المجموع مطلوب',
            'total.numeric' => 'المجموع يجب ان يكون رقم',
            'total.min' => 'المجموع يجب ان يكون اكبر من 0',

            'evaluation.min' => 'التقييم يجب ان بكون اكبر من 0',
            'evaluation.max' => 'التقييم يجب ان بكون اقل من 5',
            'evaluation.numeric' => 'التقييم يجب ان يكون رقم',

            'driver_id.required' => 'السائق مطلوب',

            'order_status_id.required' => 'حالةالطلب مطلوب',

            'supermarket_name.required' => 'اسم السوبر ماركت مطلوب',
            'supermarket_name.string' => 'اسم السوبر ماركت يجب ان يكون نص',
            'supermarket_name.max' => 'اسم السوبر ماركت يجب ان لا يزيد عن 255 حرف',


        ]);
        $data = $request->all();
        $order = Orders::create($data);

        return response()->json(['code' => 200
                                , 'status' => true,
                                'order' => $order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        $order_data = Orders::with('cases','drivers','customers')->findOrFail($order);

        return response()->json(['code' => 200
                                , 'status' => true,
                                'order' => $order_data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order)
    {
        $request->validate([
            'order_number' => ['required', 'numeric',"unique:orders,order_number,$order", 'min:0'],
            'products_number' => ['required', 'numeric', 'min:0'],
            'customer_id' => ['required'],
            'total' => ['required', 'numeric', 'min:0'],
            'driver_id' => ['required'],
            'order_status_id' => ['required'],
            'evaluation'=> ['numeric','min:0' , 'max:5'],
        ],[
            'order_number.required' => 'رقم الطلب مطلوب',
            'order_number.numeric' => 'رقم الطلب يجب ان يكون رقم',
            'order_number.min' => 'رقم الطلب يجب ان يكون اكبر من 0',
            'order_number.unique' => 'رقم الطلب موجود يالفعل!!',

            'products_number.required' => 'عدد المنتجات مطلوب',
            'products_number.numeric' => 'عدد المنتجات يجب ان يكون رقم',
            'products_number.min' => 'عدد المنتجات يجب ان يكون اكبر من 0',

            'total.required' => 'المجموع مطلوب',
            'total.numeric' => 'المجموع يجب ان يكون رقم',
            'total.min' => 'المجموع يجب ان يكون اكبر من 0',

            'evaluation.min' => 'التقييم يجب ان بكون اكبر من 0',
            'evaluation.max' => 'التقييم يجب ان بكون اقل من 5',
            'evaluation.numeric' => 'التقييم يجب ان يكون رقم',

            'driver_id.required' => 'السائق مطلوب',

            'order_status_id.required' => 'حالةالطلب مطلوب',

            'supermarket_name.required' => 'اسم السوبر ماركت مطلوب',
            'supermarket_name.string' => 'اسم السوبر ماركت يجب ان يكون نص',
            'supermarket_name.max' => 'اسم السوبر ماركت يجب ان لا يزيد عن 255 حرف',


        ]);
        $data = $request->all();

        $order_data = Orders::findOrFail($order);


        $order_data->update($data);

        return response()->json(['code' => 200
                                , 'status' => true,
                                'order' => $order_data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order)
    {
        $order_data = Orders::findOrFail($order);


        $order_data->delete();
        return response()->json(['code' => 200
                                , 'status' => true,
                                'message' => 'تمت العمليه بنجاح!!']);
    }
}
