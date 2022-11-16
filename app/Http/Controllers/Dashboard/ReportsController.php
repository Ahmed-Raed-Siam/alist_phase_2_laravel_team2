<?php

namespace App\Http\Controllers\Dashboard;

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
    public function index(Request $request)
    {
        $reports = Report::when($request->number_of_orders, function($query,$value){
            $query->where('reports.number_of_orders','LIKE',"%$value%");
        })->with('product')->get();

        
        return view('dashboard.reports.index',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report = new Report();
        $product = Product::all();

        return view('dashboard.reports._form',compact('product'));
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

        if(!empty($OrdersProductDetail))
        {
        $report = Report::create([
            'product_id' => $request->product_id,
            'number_of_products' => $number_of_products,
            'total_outgoing_quantity' => $produect_unit,
            'total_price' => $total_price,
            'number_of_orders' => $number_of_orders,
        ]);
        }
        else
        {
            $report = Report::create([
                'product_id' => $request->product_id,
                'number_of_products' => 0,
                'total_outgoing_quantity' => 0,
                'total_price' => 0,
                'number_of_orders' => 0,
            ]);
        }

        return redirect()->route('reports.index')->with('success', "Report created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::findOrFail($id);
        $product = Product::all();

        return view('dashboard.reports._form-edit',compact('report','product'));
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

        

        if(!empty($OrdersProductDetail))
        {
            $report->update([
                'product_id' => $request->product_id,
                'number_of_products' => $number_of_products,
                'total_outgoing_quantity' => $produect_unit,
                'total_price' => $total_price,
                'number_of_orders' => $number_of_orders,
            ]);
        }
        else
        {
            $report = Report::create([
                'product_id' => $request->product_id,
                'number_of_products' => 0,
                'total_outgoing_quantity' => 0,
                'total_price' => 0,
                'number_of_orders' => 0,
            ]);
        }
        

        return redirect()->route('reports.index')->with('success', "Report created!");
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
        return back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $report = Report::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Reports Deleted successfully."]);
    }
}
