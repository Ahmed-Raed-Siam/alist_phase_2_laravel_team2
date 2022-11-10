<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request)
    {
        $categories = Category::when($request->en_name, function ($query, $value) {
            $query->where('categories.en_name', 'LIKE', "%$value%");
        })
            ->when($request->ar_name, function ($query, $value) {
                $query->where('categories.ar_name', '=', $value);
            })->get();

        return response()->json(['code' => 200, 'status' => true, 'categories' => $categories,]);
    }


    public function index()
    {
        $categories = Category::with('main')->get();

        return response()->json(['code' => 200, 'status' => true, 'categories' => $categories]);
    }

    public function indexmain($id)
    {
        $categories = Category::with('main')->where('main_id',$id)->get();

        return response()->json(['code' => 200, 'status' => true, 'categories' => $categories]);
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
            'en_name' => 'required',
            'ar_name' => 'required',
            'image' => 'required',
            'main_id' => 'nullable|exists:categories,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/images', [
                'disk' => 'uploads'
            ]);
        }

        $category = Category::create($data);

        return response()->json(['code' => 200, 'status' => true, 'category' => $category]);
    }

    public function storemain(Request $request)
    {
        $request->validate([
            'en_name' => 'required',
            'ar_name' => 'required',
            'image' => 'required',
            'main_id' => 'nullable|exists:categories,id'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/images', [
                'disk' => 'uploads'
            ]);
        }

        $category = Category::create($data);

        return response()->json(['code' => 200, 'status' => true, 'category' => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json(['code' => 200, 'status' => true, 'category' => $category]);
    }

    public function showmain($id)
    {
        $category = Category::findOrFail($id);

        return response()->json(['code' => 200, 'status' => true, 'category' => $category]);
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
            'en_name' => 'required',
            'ar_name' => 'required',
            'image' => 'required',
            'main_id' => 'nullable|exists:categories,id'
        ]);

        $category = Category::findOrFail($id);
        $data = $request->all();

        $previous = false;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/images', [
                'disk' => 'uploads'
            ]);
            $previous = $category->image;
        }

        $category->update($data);
        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }

        return response()->json(['code' => 200, 'status' => true, 'category' => $category]);
    }

    public function updatemain(Request $request, $id)
    {
        $request->validate([
            'en_name' => 'required',
            'ar_name' => 'required',
            'image' => 'required',
            'main_id' => 'nullable|exists:categories,id'
        ]);

        $category = Category::findOrFail($id);
        $data = $request->all();

        $previous = false;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/images', [
                'disk' => 'uploads'
            ]);
            $previous = $category->image;
        }

        $category->update($data);
        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }

        return response()->json(['code' => 200, 'status' => true, 'category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['code' => 200, 'status' => true, 'message' => 'تم']);
    }

    public function destroymain($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['code' => 200, 'status' => true, 'message' => 'تم']);
    }
}
