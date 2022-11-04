<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CustomerManagment;
use App\Models\DeliveryDrivers;
use App\Models\OrderCases;
use App\Models\orders;
use App\Models\OrdersProduct;
use App\Models\OrdersProductDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OrdersProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = OrdersProduct::all();

        if ($request->ajax()) {

            return datatables()->of($orders)
                ->addcolumn('actions', function (OrdersProduct $orders) {
                    $edit = '<a href="javascript:void(0);"  class="dropdown-item editRecord" data-toggle= "modal" data-id= "' . $orders->id . '" title="تعديل "><i class="ti-marker-alt"></i>تعديل</a>';

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
                ->addColumn('products_number', function ($model) {

                    return $model->total_items;
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

                    $driver = "<select class=custom-select data-id='$model->id' data-placeholder='اختر سائق' name=driver id=driver-order-product style='width: auto;'>.$option.</select>";

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
                    $status= "<select class=custom-select data-id='$model->id' data-placeholder='اختر حالة' name=status id=status-order-product style='width: auto;'>.$option.</select>";


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
                ->rawColumns(['actions','status','driver','date','time','total','products_number','supermarket','evaluation'])
                ->addIndexColumn()
                ->make(true);
        }
        $products =  Product::where('status', 'Available')->get();
        $order_cases = OrderCases::all();
        $delivers = DeliveryDrivers::all();
        $customers = CustomerManagment::all();

        return view('dashboard.orders_product.index', [
            'products' => $products,
            'delivers' => $delivers,
            'order_cases' => $order_cases,
            'customers' => $customers,
            'location_title' => 'طلبات المنتجات',
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

        public function show($id)
    {
        $data = OrdersProduct::findOrFail($id);
        $data['order_number'] = $data->order_number;
        $data['supermarket_name'] = $data->customers->supermarket_name;
        $data['evaluation'] = $data->evaluation;
        $data['total'] = $data->total;
        $data['total_items'] = $data->total_items;
        $data['date'] = $data->created_at->format('d-m-Y');
        $data['time'] = $data->created_at->format('h:i:s A');
        $data['name'] = $data->users->name ?? 'لا يوجد';
        $data['email'] = $data->users->email ?? 'لا يوجد';
        $data['driver'] = $data->drivers->name ?? 'لا يوجد';
        $data['status'] = $data->cases->name ?? 'لا يوجد';
        $data['items'] = OrdersProductDetail::with('product')->where('order_id' ,$data->id)->get();

        return $data;
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
            'order_number' => ['required', 'numeric', 'unique:orders_products,order_number', 'min:0'],
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

        $products = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
        $total = $products->sum(function($item) {
            return $item->product->product_price * $item->quantity;
        });
        $data = $request->all();
        $data['total'] = $total;
        $data['total_items'] = count($products);

        DB::beginTransaction();
        try {
            $order = OrdersProduct::create($data);

            foreach ($products as $item) {
                $order_item = $order->items()->create([
                    'order_id' => $order->id ,
                    'product_id' => $item->product_id,
                    'qty' => $item->quantity,
                    'name' => $item->product->product_name,
                    'price' => $item->product->product_price,
                ]);
            }

            Cart::where('user_id', Auth::id())
                ->delete();

            DB::commit();

            if (!empty($order)) {
                return response()->json([
                    'success' => true,
                    'cart-id' => $order->id,
                ]);
            }



        } catch (Throwable $e) {
            return response()->json([
                'success'=> false,
                'cart_id' => $order->id,
            ], 200);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function copy($id)
    {
        $order = OrdersProduct::with('items')->findOrFail($id);
        $randomNumber = random_int(1000, 9999);

        $record = OrdersProduct::create([
            'order_number'      => $order->order_number . $randomNumber,
            'total_items'   => $order->total_items,
            'total'      => $order->total,
            'driver_id'          => $order->driver_id,
            'order_status_id'          => $order->order_status_id,
            'evaluation'          => $order->evaluation,
            'customer_id'          => $order->customer_id,
            'created_at'          => Carbon::now(),
            'updated_at'          => Carbon::now(),
        ]);

        $items = OrdersProductDetail::with('product')->where('order_id' ,$order->id)->get();
        foreach ($items as $item){
            $order_item = $record->items()->create([
                'order_id' => $record->id ,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'name' => $item->name,
                'price' => $item->price,
            ]);
        }
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
    public function productUpdate(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['int', 'min:1'],
        ]);

        $product_id = $request->post('product_id');

        $product = OrdersProductDetail::where('order_id', $request->post('order_id'))->where('product_id',$product_id)->first();
        $product->update([
            'qty' =>  $request->post('quantity'),
        ]);

        $order = OrdersProduct::findOrFail($request->post('order_id'));
        $items = OrdersProductDetail::with('product')->where('order_id' ,$request->post('order_id'))->get();

        $total = $items->sum(function($item) {
            return $item->price * $item->qty;
        });

        $order->update([
            'total' =>$total
        ]);
        if (!empty($product)) {
            return response()->json([
                'success' => true,
                'product_id' => $product->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'product_id'=> $product->id,
        ], 200);

    }

    public function productAdd(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'qty' => ['required','int', 'min:1'],
            'order_id' => ['required','int', 'min:1'],
        ],[
            'qty.required' => 'الكمية مطلوب',
            'qty.min' => 'الكمية يجب ان تكون اكبر من 0'

        ]);

        $product_id = $request->post('product_id');
        $quantity = $request->post('qty');
        $item1 = Product::find($product_id);


        $items_order = OrdersProductDetail::where('order_id', $request->post('order_id'))->get();
        foreach($items_order as $value){
            if($value->product_id == $product_id){
                return response()->json([
                    'exists' => false,
                    'product_id' => $product_id,
                ]);
            }
         }

        $order = OrdersProduct::findOrFail($request->post('order_id'));

        $order_item = $order->items()->create([
            'order_id' => $order->id ,
            'product_id' => $product_id,
            'qty' => $quantity,
            'name' => $item1->product_name,
            'price' => $item1->product_price,
        ]);
        $items = OrdersProductDetail::with('product')->where('order_id' ,$request->post('order_id'))->get();

        $total = $items->sum(function($item) {
            return $item->price * $item->qty;
        });

        $order->update([
            'total' =>$total,
            'total_items' => count($items),
        ]);

        if (!empty($order_item)) {
            return response()->json([
                'success' => true,
                'product_id' => $order_item->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'product_id'=> $order_item->id,
        ], 200);

    }

    public function productDelete(Request $request)
    {

        $product_id = $request->post('product_id');
        $order_id = $request->post('order_id');
        $order = OrdersProduct::findOrFail($order_id);

        $items = OrdersProductDetail::with('product')->where('order_id' ,$order->id)->get();
        if(count($items) == 1){
            return response()->json([
                'empty' => true,
            ]);
        }
        $items_order = OrdersProductDetail::where('order_id', $order->id)->where('product_id',$product_id)->first();

        $items_order->delete();

        $items = OrdersProductDetail::with('product')->where('order_id' ,$order->id)->get();


        $total = $items->sum(function($item) {
            return $item->price * $item->qty;
        });

        $order->update([
            'total' =>$total,
            'total_items' => count($items),
        ]);

        if (!empty($items_order)) {
            return response()->json([
                'success' => true,
                'items' => OrdersProductDetail::with('product')->where('order_id' ,$order->id)->get(),
            ]);
        }

        return response()->json([
            'success'=> false,
            'items' => OrdersProductDetail::with('product')->where('order_id' ,$order->id)->get(),
        ], 200);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = OrdersProduct::findOrFail($id);
        return response()->json([
            'order' => $order,
            'items' => OrdersProductDetail::with('product')->where('order_id' ,$order->id)->get(),
        ]);
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
        $record = OrdersProduct::find($record_id);

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
        $record = OrdersProduct::find($record_id);

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
            'order_number' => ['required', 'numeric',"unique:orders_products,order_number,$id", 'min:0'],
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

        $order = OrdersProduct::findorFail($id);
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
        $order = OrdersProduct::findorFail($id);
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
        $order = OrdersProduct::whereIn('id', $order_id_array);
        $order->delete();

    }

    public function deliverAll(Request $request)
    {
        $orders_id_array = $request->input('id');

        foreach ($orders_id_array as $order_id) {
            $order = OrdersProduct::find($order_id)->update([
                'order_status_id' => 1,
            ]);

        }


    }
}
