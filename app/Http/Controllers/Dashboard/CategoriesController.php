<?php

namespace App\Http\Controllers\Dashboard;

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
    public function index(Request $request)
    {
        $categories = Category::when($request->en_name, function($query,$value){
            $query->where('categories.en_name','LIKE',"%$value%");
        })
        ->when($request->ar_name,function($query,$value){
            $query->where('categories.ar_name','=',$value);
        })->with('main')->orderBy('ar_name','asc')->get();

        
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();

        $main = Category::all();

        return view('dashboard.categories._form',compact('category','main'));
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

        return redirect()->route('categories.index')->with('success', "Category created!");
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
        $category = Category::findOrFail($id);

        $main = Category::where('id',$id)->get();

        return view('dashboard.categories._form-edit',compact('category','main'));
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

        return redirect()->route('categories.index')->with('succes', "Category update!");
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
        return back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $category = Category::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Categories Deleted successfully."]);
    }
}
