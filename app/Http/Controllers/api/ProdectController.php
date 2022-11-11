<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('categories')->get();
        return response()->json(['cood' => 200, 'status' => true, 'prodects' => $product]);
    }
    
    public function search_product(Request $request)
    {
        $products = Product::when($request->product_name, function ($query, $value) {
            $query->where('products.product_name', 'LIKE', "%$value%");
        })->when($request->ar_name, function ($query, $value) {
            $query->where('products.product_name_en', '=', $value);
        })->get();
        

        return response()->json(['code' => 200, 'status' => true, 'products' => $products,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_picture' => 'required',
            'product_name' => 'required',
             'product_name_en' => 'required',
            'product_date' => 'required',
            'product_price' => 'required',
            'product_barcode' => 'required',
            'produect_unit' => 'required',
            'status' => 'required',
            'product_details' => 'required',
            'category_id' => 'required',
        ]);
        if ($request->hasFile('product_picture')) {
            $file = $request->file('product_picture');

            $data['product_picture'] = $file->store('/images', [
                'disk' => 'uploads'
            ]);
        }
        $product = Product::create($data);

        return response()->json(['code' => 200, 'status' => true, 'product' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $product = Product::with('categories')->findOrFail($id);
       


        $products=Product::where('category_id', '=', $id)
        ->get();
         if ($product != '')
         {
                return response()->json(['code' => 200, 'status' => true, 'product' => $product,'paired'=>$products]);
         }else{
            return 'لا يوجد منتجات';
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $product = Product::find($id);
        $data = $request->validate([
            'product_name' => 'required',
             'product_name_en' => 'required',
            'product_date' => 'required',
            'product_price' => 'required',
            'product_barcode' => 'required',
            'produect_unit' => 'required',
            'status' => 'required',
            'product_details' => 'required',
        ]);
        $previous = false;
        if ($request->hasFile('product_picture')) {
            $file = $request->file('product_picture');
            $data['product_picture'] = $file->store('/images', [
                'disk' => 'uploads'
            ]);
            $previous = $product->product_picture;
        }



        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }
        $product->update($data);
        return response()->json(['code' => 200, 'status' => true, 'product' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['code' => 200, 'status' => true, 'message' => 'تم الحذف بنجاح']);
    }
}
