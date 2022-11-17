<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryManagementRequest;
use App\Http\Requests\UpdateDeliveryManagementRequest;
use App\Models\DeliveryDrivers;
use App\Models\DeliveryManagement;
use App\Models\Orders;
use App\Models\OrdersProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;


class DeliveryManagementController extends Controller
{

    public function __construct(Request $request){

        // $this->authorizeResource(DeliveryManagement::class,Str::snake("DeliveryManagement"));
    }

    public function index(Request $request)
    {
        $items = DeliveryManagement::with(['driver' , 'order'])->search($request)->sort($request)->paginate(15);

        return response()->view('dashboard.delivery_management.index', compact('items'));

    }

    public function create (){
        $orders = OrdersProduct::all();
        $drivers = DeliveryDrivers::all();

         return response()->view('dashboard.delivery_management.create' , compact('orders' , 'drivers'));

    }


    public function store(StoreDeliveryManagementRequest $request)
    {
        $deliveryManagement = DeliveryManagement::create($request->validated());

          return response()->json(['message' => $deliveryManagement ? 'Created Successfully' : 'Failed To Create'], $deliveryManagement ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    public function show(Request $request,DeliveryManagement $deliveryManagement)
    {
         return response()->view('', compact('deliveryManagement'));
    }

    public function edit(Request $request,  $id){

        $item =  DeliveryManagement::find($id);

        // dd($deliveryManagement);
        $orders = OrdersProduct::all();
        $drivers = DeliveryDrivers::all();
         return response()->view('dashboard.delivery_management.edit', compact('item' , 'orders' , 'drivers'));


    }

    public function update(UpdateDeliveryManagementRequest $request, DeliveryManagement $deliveryManagement)
    {
        $deliveryManagement->update($request->validated());

         return response()->json(['message' => $deliveryManagement ? 'Updated Successfully' : 'Failed To Updated'], $deliveryManagement ?Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function destroy(Request $request,  $id)
    {


        $deleted = DeliveryManagement::find($id)->delete();

        if ($deleted) {
            return response()->json(['title' => 'تم الحذف! ', 'message' => ' تمت العملية بنجاح', 'icon' => 'success'], Response::HTTP_OK);
        } else {
            return response()->json(['title' => 'فشل!', 'message' => 'فشلت العملية', 'icon' => 'error'],  Response::HTTP_BAD_REQUEST);
        }
    }


    public function updateMany(Request $request , $status )
    {

       $updated =  DeliveryManagement::whereIn('id' , $request->all())->update(['status' => $status ]);
         return response()->json(['message' => $updated ? 'Updated Successfully' : 'Failed To Updated'], $updated ?Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }


    public function deleteMany(Request $request)
    {

        $deleted = DeliveryManagement::whereIn('id',$request->ids)->delete();
        if ($deleted) {
            return response()->json(['title' => 'تم الحذف!', 'message' => ' تمت العملية بنجاح', 'icon' => 'success'], Response::HTTP_OK);
        } else {
            return response()->json(['title' => 'فشل!', 'message' => 'فشلت العملية', 'icon' => 'error'],  Response::HTTP_BAD_REQUEST);
        }
    }
}
