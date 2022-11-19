<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\OrdersProduct;
use App\Models\OrdersProductDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdersProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = OrdersProduct::with('cases','drivers','items','customers')->where('customer_id',Auth::user()->customer->id)->get();
        $order_all = array();

        foreach ($orders as $order_f) {

            $order = OrdersProduct::find($order_f->id);

            $order_items = array();
            foreach ($order->items as $item) {
                $item1 = Product::find($item->product_id);
                if ($item1) {
                    $item_data = $item1;
                    $item_data['qty'] = $item->qty;

                    array_push($order_items, $item_data);
                }
            }

            $data = [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'evaluation' => $order->evaluation,
                'total' => $order->total,
                'total_items' => $order->total_items,
                'customers' => $order->customers ?? [],
                'cases' => $order->cases ?? [],
                'drivers' => $order->drivers ?? [],
                'items' => $order_items,
            ];

            array_push($order_all, $data);

        }

        return response()->json(['code' => 200
                                , 'status' => true,
                                'orders' => $order_all]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $products = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
        $total = $products->sum(function($item) {
            return $item->product->product_price * $item->quantity;
        });
        if (empty($products[0])) {
            return response()->json([
                'success' => true,
                'message' => 'السلة فارغة',
            ]);
        }

        $data = $request->all();
        $data['order_number'] = random_int(1000, 9999);
        $data['order_status_id'] = 4;
        $data['driver_id'] =null;
        $data['customer_id'] =Auth::user()->customer->id;
        $data['evaluation'] = 0;
        $data['total'] = $total;
        $data['total_items'] = count($products);

        DB::beginTransaction();
        try {
            $order = OrdersProduct::create($data);

            foreach ($products as $item) {
                $order_item = $order->items()->create([
                    'order_id' => $order->id ,
                    'product_id' => $item->product_id,
                    'name' => $item->product->product_name,
                    'qty' => $item->quantity,
                    'price' => $item->product->product_price,
                ]);
            }

            Cart::where('user_id', Auth::id())
                ->delete();

            DB::commit();

            if (!empty($order)) {
                return response()->json([
                    'success' => true,
                    'order_id' => $order->id,
                ]);
            }



        } catch (Throwable $e) {
            return response()->json([
                'success'=> false,
                'order_id' => $order->id,
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order)
    {
        $order = OrdersProduct::find($order);
        if(!$order){
            return response()->json(['code' => 200
                , 'status' => true,
                'msg' => 'Not Found']);
        }
        $order_items = array();
        foreach ($order->items as $item){
            $item1 = Product::find($item->product_id);
            if($item1){
                $item_data = $item1;
                $item_data['qty'] = $item->qty ;

                array_push($order_items, $item_data);
            }
        }

        $data = [
            'id' => $order->id,
            'order_number' => $order->order_number,
            'evaluation' => $order->evaluation,
            'total' => $order->total,
            'total_items' => $order->total_items,
            'customers' => $order->customers ?? [],
            'cases' => $order->cases ?? [],
            'drivers' => $order->drivers ?? [],
            'items' => $order_items,
        ];




        return response()->json(['code' => 200
                                , 'status' => true,
                                'order' => $data]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productUpdate(Request $request)
    {
        $request->validate([
            'product_id' => ['required'],
            'quantity' => ['int', 'min:1'],
        ]);
        $order = OrdersProduct::findOrFail($request->post('order_id'));
        $product_id = $request->post('product_id');

        $product = OrdersProductDetail::where('order_id', $request->post('order_id'))->where('product_id',$product_id)->first();
        $product->update([
            'qty' =>  $request->post('quantity'),
        ]);

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
            'product_id' => ['required'],
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
                    'message' => 'المنتج موجود بالفعل',
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
            'item_id'=> $order_item->id,
        ], 200);

    }

    public function productDelete(Request $request)
    {
        $request->validate([
            'product_id' => ['required'],
        ]);
        $product_id = $request->product_id;
        $order_id = $request->order_id;
        $order = OrdersProduct::findOrFail($order_id);

        $items = OrdersProductDetail::with('product')->where('order_id' ,$order->id)->get();


            if(!$items){
                return response()->json([
                    'success' => false,
                    'message' => 'لا يوجد',
                ]);
            }
        if(count($items) == 1){
            return response()->json([
                'success' => false,
                'message' => 'الطلب به منتج واحد فقط',
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

        if (!empty($order)) {
            return response()->json([
                'success' => true,
                'items_order' => $order,
            ]);
        }

        return response()->json([
            'success'=> false,
            'items_order' => $order,
        ], 200);

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
            'order_number' => ['required', 'numeric',"unique:orders_products,order_number,$order", 'min:0'],
            'customer_id' => ['required'],
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
        $order1 = OrdersProduct::findorFail($order);


        $order1->update($data);

        if (!empty($order1)) {
            return response()->json([
                'success' => true,
                'order_id' => $order1->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'order_id' => $order1->id,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order)
    {
        $order_data = OrdersProduct::findOrFail($order);
        if(!$order_data){
            return response()->json([
                'success' => false,
                'message' => 'لا يوجد',
            ]);
        }
        $order_data->delete();
        return response()->json(['code' => 200
                                , 'status' => true,
                                'message' => 'تمت العمليه بنجاح!!']);
    }
}
