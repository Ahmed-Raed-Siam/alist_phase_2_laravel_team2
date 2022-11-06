<?php

namespace App\Http\Controllers\Api\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Report;
use App\Models\Orders;
use App\Models\OrdersProductDetail;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $reports = Report::when($request->number_of_orders, function($query,$value){
            $query->where('reports.number_of_orders','LIKE',"%$value%");
        })->with('product')->get();

        return response()->json(['code'=>200 ,'status'=>true, 'reports'=>$reports,]);
    }

    public function index()
    {
        $reports = Report::with('product')->get();

        return response()->json(['code'=>200 ,'status'=>true, 'reports'=>$reports,]);
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
            'product_id' => 'required',
        ]);

        $product_id = $request->product_id;
        $product = Product::where('id',$request->product_id)->first();
        $number_of_products = $product->produect_unit;

        $OrdersProductDetail = OrdersProductDetail::where('product_id',$product_id)->get();
       

        $produect_unit = OrdersProductDetail::where('product_id',$product_id)->sum('orders_product_details.qty');
        
        $total_price = OrdersProductDetail::where('product_id',$product_id)->sum('orders_product_details.price');
        $number_of_orders = OrdersProductDetail::where('product_id',$product_id)->count('orders_product_details.id');

        

        
        $report = Report::create([
            'product_id' => $request->product_id,
            'number_of_products' => $number_of_products,
            'total_outgoing_quantity' => $produect_unit,
            'total_price' => $total_price,
            'number_of_orders' => $number_of_orders,
        ]);

        return response()->json(['code'=>200 ,'status'=>true, 'reports'=>$reports,]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reports = Report::with('product')->findOrFail($id);

        return response()->json(['code'=>200 ,'status'=>true, 'reports'=>$reports]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required',
        ]);

        $report = Report::findOrFail($id); 

        $product_id = $request->product_id;
        $product = Product::where('id',$request->product_id)->first();
        $number_of_products = $product->produect_unit;

        $OrdersProductDetail = OrdersProductDetail::where('product_id',$product_id)->get();
       

        $produect_unit = OrdersProductDetail::where('product_id',$product_id)->sum('orders_product_details.qty');
        
        $total_price = OrdersProductDetail::where('product_id',$product_id)->sum('orders_product_details.price');
        $number_of_orders = OrdersProductDetail::where('product_id',$product_id)->count('orders_product_details.id');

        

        
        $report->update([
            'product_id' => $request->product_id,
            'number_of_products' => $number_of_products,
            'total_outgoing_quantity' => $produect_unit,
            'total_price' => $total_price,
            'number_of_orders' => $number_of_orders,
        ]);

        return response()->json(['code'=>200 ,'status'=>true, 'reports'=>$reports]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return response()->json(['code'=>200 ,'status'=>true, 'message' => 'تم']);
    }
}
