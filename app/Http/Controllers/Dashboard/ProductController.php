<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $products  = Product::all();
        return view('dashboard.product.indexProduct', compact('products', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('dashboard.product.createProduct', compact('category'));
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
            'product_picture' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'product_name' => 'required',
            'product_name_en' => 'required',
            'product_date' => 'required',
            'product_price' => 'required',
            'product_barcode' => 'required',
            'produect_unit' => 'required',
            'status' => 'required',
            'product_details' => 'required',
            'category_id' => 'required'
        ]);

        if ($request->hasFile('product_picture')) {
            $file = $request->file('product_picture');

            $data['product_picture'] = $file->store('/images', [
                'disk' => 'uploads'
            ]);
        }
        $products = Product::create($data);

        return redirect()->route('products.index')->with('success', "تم اضافة المنتج بنجاح");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        $category = Category::all();
        return view('dashboard.product.editProduct', compact('products', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products = Product::find($id);
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
        $photo = false;
        if ($request->hasFile('product_picture')) {
            $file = $request->file('product_picture');
            $data['product_picture'] = $file->store('/images', [
                'disk' => 'uploads'
            ]);
            $photo = $products->product_picture;
        }
        if ($photo) {
            Storage::disk('uploads')->delete($photo);
        }
        $products->update($data);

        return redirect()->route('products.index')->with('success', 'تم تعديل المنتج بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'تم حذف المنتج بنجاح');
    }

    /**
     * Delete All Select Product
     */
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $product = Product::whereIn('id', explode(',', $ids))->delete();
        return response()->json(['success' => "تم حذف المنتج بنجاح"]);
    }
    /**
     * Show All Delete Product
     */
    public function indexDeleteProduct(Request $request)
    {
        $products = Product::onlyTrashed()->get();
        return view('dashboard.product.indexAllDelete', compact('products'));
    }
    /**
     * Restore Product
     */
    public function restoreProduct($id)
    {
        Product::withTrashed()->find($id)->restore();

        return redirect()->route('products.index')->with('sucsses', 'تم استرجاع المنتج بنجاح');
    }
    /**
     * Restore All Prodect
     */
    public function restoreAllProduct()
    {
        Product::onlyTrashed()->restore();
        return redirect()->route('products.index')->with('sucsses', "تم استرجاع جميع المنتج بنجاح");
    }
}
