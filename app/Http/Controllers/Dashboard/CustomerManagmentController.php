<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerManagementRequest;
use App\Models\CustomerManagment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CustomerManagmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customerManagments = CustomerManagment::all();

        return response()->view('dashboard.CustomerManagment.index', [
            'customerManagment' => $customerManagments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return response()->view('dashboard.CustomerManagment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerManagementRequest $request)
    {
        //
        $customerManagement = new CustomerManagment();
        $customerManagement->shop_owner_name = $request->input(
            'shop_owner_name'
        );
        $customerManagement->supermarket_name = $request->input(
            'supermarket_name'
        );
        $customerManagement->address = $request->input('address');
        $customerManagement->mobile = $request->input('mobile');
        $customerManagement->email = $request->input('email');
        $customerManagement->total_point = $request->input('total_point');

        if ($request->hasFile('customer_image')) {
            $image = $request->file('customer_image');
            $imageName =
                Carbon::now()->format('Y_m_d_h_i') .
                '_' .
                $customerManagement->name .
                '.' .
                $image->getClientOriginalExtension();
            $request
                ->file('customer_image')
                ->storeAs('/customer', $imageName, ['disk' => 'public']);
            $customerManagement->customer_image = 'customer/' . $imageName;
        }

        $isSaved = $customerManagement->save();

        return response()->json(
            [
                'message' => $isSaved ? 'تم الانشاء بنجاح' : 'فشل الانشاء',
            ],
            $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerManagment  $customerManagment
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerManagment $customerManagment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerManagment  $customerManagment
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerManagment $customerManagment , $id)
    {
        $customerManagment = CustomerManagment::findOrFail($id);
        return response()->view('dashboard.CustomerManagment.edit', compact('customerManagment'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerManagment  $customerManagment
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerManagementRequest $request,CustomerManagment $customerManagment , $id ) {

        $customerManagement = CustomerManagment::findOrFail($id);
        $customerManagement->shop_owner_name = $request->input( 'shop_owner_name' );
        $customerManagement->supermarket_name = $request->input('supermarket_name');
        $customerManagement->address = $request->input('address');
        $customerManagement->mobile = $request->input('mobile');
        $customerManagement->email = $request->input('email');
        $customerManagement->total_point = $request->input('total_point');
        // dd($request->all());
        if ($request->hasFile('customer_image')) {
            Storage::disk('public')->delete($customerManagement->customer_image);
            $image = $request->file('customer_image');
            $imageName =
                Carbon::now()->format('Y_m_d_h_i') .
                '_' .
                $customerManagement->name .
                '.' .
                $image->getClientOriginalExtension();
            $request
                ->file('customer_image')
                ->storeAs('/customer', $imageName, ['disk' => 'public']);
            $customerManagement->customer_image = 'customer/' . $imageName;
            // dd($customerManagement->customer_image);
        }

        $isUpdated = $customerManagement->update();

        return response()->json(
            [
                'message' => $isUpdated ? 'تم الانشاء بنجاح' : 'فشل الانشاء',
            ],
            $isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
        );
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerManagment  $customerManagment
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerManagment $customerManagment , $id)
    {
        $customerManagment = CustomerManagment::findOrFail($id);
        $imageName = $customerManagment->customer_image;
        $isDeleted = $customerManagment->delete();
        if ($isDeleted) Storage::disk('public')->delete($imageName);
        return response()->json([
            'title' => $isDeleted ? 'تم الحذف بنجاح' : "فشل الحذف",
            'icon' => $isDeleted ? 'success' : "error",
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

}
