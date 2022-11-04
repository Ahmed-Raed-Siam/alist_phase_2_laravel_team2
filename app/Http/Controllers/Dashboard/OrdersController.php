<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CustomerManagment;
use App\Models\DeliveryDrivers;
use App\Models\OrderCases;
use App\Models\orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Orders::all();

        if ($request->ajax()) {

            return datatables()->of($orders)
                ->addcolumn('actions', function (Orders $orders) {
                    $edit = '<a href="javascript:void(0);"  class="dropdown-item editRecord" data-toggle= "modal" data-id= "' . $orders->id . '" title="تعديل "><i class="ti-pencil-alt"></i>تعديل</a>';

                    $delete = '<a href="javascript:void(0);" class="dropdown-item deleteRecord" data-toggle= "modal" id= "' . $orders->id . '" title="حذف "><i class="ti-trash"></i>حذف</a>';

                    $show = '<a href="javascript:void(0);" class="dropdown-item showRecord" data-toggle= "modal" data-id= "' . $orders->id . '" title="عرض "><i class="ti-eye"></i>عرض</a>';

                    $copy = '<a href="javascript:void(0);" class="dropdown-item copyRecord" id= "' . $orders->id . '" title="نسخ "><i class="ti-files"></i>نسخ</a>';

                    $button = '<div class="btn-group">
                                                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ti-settings"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                                                                        '. $show . $edit . $delete . $copy .'
                                                                    </div>
                                                                </div>';
                    return $button;
                })
                ->addColumn('total', function ($model) {

                    $total = '<h5 style="color: #00e000;text-align: center">$' . $model->total . '<h5/>';

                    return $total;
                })
                ->addColumn('date', function ($model) {

                    return $model->created_at->format('d-m-Y');
                })
                ->addColumn('time', function ($model) {

                    return $model->created_at->format('h:i:s A');
                })
                ->addColumn('driver', function ($model) {
                    $delivers = DeliveryDrivers::all();

                    if (!empty($model->drivers)){
                        $option = '';
                        foreach ($delivers as $deliver){
                            $selected = '';
                            if($deliver->id == $model->drivers->id){
                                $selected = 'selected';
                            }
                            $option .= '<option value='.$deliver->id.'  '.$selected.'>'.$deliver->name.'</option>';
                        }
                    }else{
                        $option = '<option value="">لا يوجد</option>';
                        foreach ($delivers as $deliver){
                            $selected = '';
                            $option .= '<option value='.$deliver->id.'  '.$selected.'>'.$deliver->name.'</option>';
                        }
                    }

                    $driver = "<select class=custom-select data-id='$model->id' data-placeholder='اختر سائق' name=driver id=driver style='width: auto;'>.$option.</select>";

                    return $driver;
                })
                ->addColumn('status', function ($model) {
                    $order_cases = OrderCases::all();

                    if (!empty($model->cases)){
                        $option = '';
                        foreach ($order_cases as $case){
                            $selected = '';
                            if($case->id == $model->cases->id){
                                $selected = 'selected';
                            }
                            $option .= '<option value='.$case->id.'  '.$selected.'>'.$case->name.'</option>';
                        }
                    }else{
                        $option = '<option value="">لا يوجد</option>';
                        foreach ($order_cases as $case){
                            $selected = '';
                            $option .= '<option value='.$case->id.'  '.$selected.'>'.$case->name.'</option>';
                        }
                    }
                    $status= "<select class=custom-select data-id='$model->id' data-placeholder='اختر حالة' name=status id=status style='width: auto;'>.$option.</select>";


                    return $status;
                })
                ->addColumn('supermarket', function ($model) {
                    if($model->customers)
                        return $model->customers->supermarket_name;
                    return 'لا يوجد';
                })
                ->editColumn('order_number', function ($model) {
                    return '#' . $model->order_number;
                })
                ->addColumn('evaluation', function ($model) {
                    $path = url('/');
                    $evaluation = "
<div id=".$model->order_number."></div>
<script>
$('#".$model->order_number."').raty({
                        path      :   '".$path."/dashboard_files/assets/images/rating', // <-- or wherever your raty images are
                        scoreName      : 'evaluation',
                        readOnly: true,
                        score     : $model->evaluation,
                    });
</script>
";
                    return $evaluation;
                })
                ->rawColumns(['actions','status','driver','date','time','total','supermarket','evaluation'])
                ->addIndexColumn()
                ->make(true);
        }

        $order_cases = OrderCases::all();
        $customers = CustomerManagment::all();
        $delivers = DeliveryDrivers::all();
        return view('dashboard.orders.index', [
            'delivers' => $delivers,
            'order_cases' => $order_cases,
            'customers' =>$customers,
            'location_title' => 'الطلبات',
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function copy($id)
    {
        $order = Orders::findOrFail($id);
        $randomNumber = random_int(1000, 9999);

        $record = Orders::create([
            'order_number'      => $order->order_number . $randomNumber,
            'products_number'     => $order->products_number,
            'total'   => $order->total,
            'driver_id'      => $order->driver_id,
            'order_status_id'          => $order->order_status_id,
            'evaluation'          => $order->evaluation,
            'customer_id'          => $order->customer_id,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);

        if (!empty($record)) {
            return response()->json([
                'success' => true,
                'order_id' => $record->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'order_id' => $record->id,
        ], 200);
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
            'order_number' => ['required', 'numeric', 'unique:orders,order_number', 'min:0'],
            'products_number' => ['required', 'numeric' , 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'driver_id' => ['required'],
            'customer_id' => ['required'],
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
            'customer_id.required' => 'السوبر ماركت مطلوب',

            'order_status_id.required' => 'حالةالطلب مطلوب',

            'supermarket_name.required' => 'اسم السوبر ماركت مطلوب',
            'supermarket_name.string' => 'اسم السوبر ماركت يجب ان يكون نص',
            'supermarket_name.max' => 'اسم السوبر ماركت يجب ان لا يزيد عن 255 حرف',


        ]);

        $order = Orders::create($request->all());
        if (!empty($order)) {
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'order_id' => $order->id,
        ], 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $data = Orders::findOrFail($id);
        $data['order_number'] = $data->order_number;
        $data['supermarket_name'] = $data->customers->supermarket_name;
        $data['evaluation'] = $data->evaluation;
        $data['total'] = $data->total;
        $data['products_number'] = $data->products_number;
        $data['date'] = $data->created_at->format('d-m-Y');
        $data['time'] = $data->created_at->format('h:i:s A');
        $data['name'] = $data->users->name ?? 'لا يوجد';
        $data['driver'] = $data->drivers->name ?? 'لا يوجد';
        $data['status'] = $data->cases->name ?? 'لا يوجد';

        return $data;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Orders::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $Orders
     * @return \Illuminate\Http\Response
     */

    public function status(Request $request)
    {
        $record_id = $request->id;
        $status = $request->value;
        $record = Orders::find($record_id);

        return $record->update([
            'order_status_id' => $status,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $Orders
     * @return \Illuminate\Http\Response
     */

    public function driver(Request $request)
    {
        $record_id = $request->id;
        $driver = $request->value;
        $record = Orders::find($record_id);

        return $record->update([
            'driver_id' => $driver,
        ]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $Orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_number' => ['required', 'numeric',"unique:orders,order_number,$id", 'min:0'],
            'products_number' => ['required', 'numeric', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'driver_id' => ['required'],
            'customer_id' => ['required'],
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
            'customer_id.required' => 'السوبر ماركت مطلوب',

            'order_status_id.required' => 'حالةالطلب مطلوب',

            'supermarket_name.required' => 'اسم السوبر ماركت مطلوب',
            'supermarket_name.string' => 'اسم السوبر ماركت يجب ان يكون نص',
            'supermarket_name.max' => 'اسم السوبر ماركت يجب ان لا يزيد عن 255 حرف',


        ]);

        $order = Orders::findorFail($id);
        $order->update($request->all());
        if (!empty($order)) {
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'order_id' => $order->id,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $Orders
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Orders::findorFail($id);
        $order->delete();

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $Orders
     * @return \Illuminate\Http\Response
     */
    public function destroyAll(Request $request)
    {
        $order_id_array = $request->input('id');
        $order = Orders::whereIn('id', $order_id_array);
        $order->delete();

    }
    public function deliverAll(Request $request)
    {
        $orders_id_array = $request->input('id');

        foreach ($orders_id_array as $order_id) {
            $order = Orders::find($order_id)->update([
                'order_status_id' => 1,
            ]);

        }


    }

}
