<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderCases;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class OrderCasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order_case = OrderCases::all();

        if ($request->ajax()) {

            return datatables()->of($order_case)
                ->addcolumn('actions', function (OrderCases $order_case) {
                    $edit = '<a href="javascript:void(0);"  class="dropdown-item editRecord" data-toggle= "modal" data-id= "' . $order_case->id . '" title="تعديل "><i class="ti-pencil-alt"></i>تعديل</a>';

                    $delete = '<a href="javascript:void(0);" class="dropdown-item deleteRecord" data-toggle= "modal" id= "' . $order_case->id . '" title="حذف "><i class="ti-trash"></i>حذف</a>';
                    if($order_case->id == 1){
                        $delete = '';
                    }
                    $button = '<div class="btn-group">
                                                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="ti-settings"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                                                                        '. $edit . $delete  .'
                                                                    </div>
                                                                </div>';
                    return $button;
                })
                ->rawColumns(['actions'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('dashboard.order_cases.index', [
            'location_title' => 'حالة الطلب',
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => ['required', 'string', 'max:255'],
        ],[
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب ان يكون نص',
            'name.max' => 'الاسم يجب ان لا يزيد عن 255 حرف',
        ]);

        $order_case = OrderCases::create($request->all());
        if (!empty($order_case)) {
            return response()->json([
                'success' => true,
                'order_case_id' => $order_case->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'order_case_id' => $order_case->id,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderCases  $OrderCases
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return OrderCases::findOrFail($id);

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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ],[
            'name.required' => 'الاسم مطلوب',
            'name.string' => 'الاسم يجب ان يكون نص',
            'name.max' => 'الاسم يجب ان لا يزيد عن 255 حرف',
        ]);

        $orderCase = OrderCases::findorFail($id);
        $orderCase->update($request->all());
        if (!empty($orderCase)) {
            return response()->json([
                'success' => true,
                'order_case_id' => $orderCase->id,
            ]);
        }

        return response()->json([
            'success'=> false,
            'order_case_id' => $orderCase->id,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderCases  $OrderCases
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderCase = OrderCases::findorFail($id);
        $orderCase->delete();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderCases  $OrderCases
     * @return \Illuminate\Http\Response
     */
    public function destroyAll(Request $request)
    {
        $orderCase_id_array = $request->input('id');
        $orderCase = OrderCases::whereIn('id', $orderCase_id_array);
        $orderCase->delete();

    }
}
