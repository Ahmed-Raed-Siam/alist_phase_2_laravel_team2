<?php

namespace App\Http\Controllers\Api\Orders;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::with('product')->where('user_id', Auth::id())->get();
        $itemsNum =count($cart);

        $total = $cart->sum(function($item) {
            return $item->product->product_price * $item->quantity;
        });

        return response()->json(['code' => 200
                                , 'status' => true,
                                'cart' => $cart,
                                'item_number' => $itemsNum,
                                'total' => $total,
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
            'quantity' => ['required', 'int', 'min:1'],
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
        return response()->json(['code' => 200
                                , 'status' => true,
                                'item' => $cart]);
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


        return response()->json(['code' => 200
            , 'status' => true,
            'item' => $cart]);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart)
    {
        $item = Cart::findOrFail($cart);
        $item->delete();

        return response()->json(['code' => 200
                                , 'status' => true,
                                'message' => 'تمت العمليه بنجاح!!']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAll()
    {

        $cart = Cart::where('user_id', '=', Auth::id())->delete();

        return response()->json(['code' => 200
            , 'status' => true,
            'message' => 'تمت العمليه بنجاح!!']);

    }
}
