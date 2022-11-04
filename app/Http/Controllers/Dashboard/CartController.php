<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\CustomerManagment;
use App\Models\DeliveryDrivers;
use App\Models\OrderCases;
use App\Models\orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();

        $itemsNum =count($cart);

        $total = $cart->sum(function($item) {
            return $item->product->product_price * $item->quantity;
        });
        $order_cases = OrderCases::all();
        $delivers = DeliveryDrivers::all();
        $customers  = CustomerManagment::all();
        return view('dashboard.orders_product.cart', [
            'location_title' => 'سلة المشتريات',
            'total' => $total,
            'items' => $cart,
            'itemsNum' => $itemsNum,
            'delivers' => $delivers,
            'order_cases' => $order_cases,
            'customers' => $customers,
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {

        $products  = Product::where('status', 'Available')->get();

        return view('dashboard.orders_product.products_cart', [
            'products' => $products,
            'location_title' => 'المنتجات',
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $that = $this;

        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['int', 'min:1'],
        ]);

        $product_id = $request->post('product_id');
        $item = Cart::where('product_id', $product_id)
            ->where(function($query) use ($that) {
                $query->where('user_id', '=', Auth::id())
                ;
            })->get();
        if(!empty($item[0])) {
            $quantityN = $item[0]->quantity;
        }else{
            $quantityN = 0;

        }
        $cart = Cart::updateOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
        ], [
            'quantity' => $quantityN + $request->post('quantity'),
        ]);

        if (!empty($cart)) {
            return response()->json([
                'success' => true,
                'cart_id' => $cart->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'cart_id' => $cart->id,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = Cart::findOrFail($id);
        $name = $cart->product->product_name;
        return response()->json(['name' =>  $name, ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orders  $Orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['int', 'min:1'],
        ]);

        $product_id = $request->post('product_id');

        $cart = Cart::updateOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
        ], [
            'quantity' => $request->post('quantity'),
        ]);

        $cartall = Cart::with('product')->where('user_id', Auth::id())->get();

        $total = $cartall->sum(function($item) {
            return $item->product->product_price * $item->quantity;
        });

        if (!empty($cart)) {
            return response()->json([
                'success' => true,
                'cart_id' => $cart->id,
                'total' => '$' . $total,
                'price'=> '$' . $cart->product->product_price * $cart->quantity,
            ]);
        }

        return response()->json([
            'success'=> false,
            'total' => '$' . $total,
            'cart_id' => $cart->id,
            'price'=> '$' . $cart->product->product_price * $cart->quantity,
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

        $item = Cart::findOrFail($id);
        $item->delete();

        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $itemsNum =count($cart);

        $total = $cart->sum(function($item) {
            return $item->product->product_price * $item->quantity;
        });
        // return redirect()->back();
        return response()->json(['cart' =>  $cart,
                                'total' => '$' . $total,
                                'cart_id'=> $item->id,
                                'item_number' => $itemsNum,
                                ]
            );
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orders  $Orders
     * @return \Illuminate\Http\Response
     */
    public function destroyAll()
    {

        $cart = Cart::where('user_id', '=', Auth::id())->delete();

        return response()->json([
                'total' => '$' . 0,
                'item_number' => 0,
            ],200
        );
    }
}
