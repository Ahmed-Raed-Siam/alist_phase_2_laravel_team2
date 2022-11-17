<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreOrderPointRequest;
use App\Http\Requests\UpdateOrderPointRequest;
use App\Models\OrderPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;


class OrderPointController extends Controller
{

    public function __construct(Request $request){
        // parent::__construct($request);
        // $this->authorizeResource(OrderPoint::class,Str::snake("OrderPoint"));
    }

    public function index(Request $request)
    {
        $items = OrderPoint::search($request)->sort($request)->paginate(15);

        return response()->view('dashboard.point_management.order_points.index', compact('items'));

    }

    public function create (){

         return response()->view('');

    }

    public function store(StoreOrderPointRequest $request)
    {
        $orderPoint = OrderPoint::create($request->validated());

          return response()->json(['message' => $orderPoint ? 'Created Successfully' : 'Failed To Create'], $orderPoint ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    public function show(Request $request,OrderPoint $orderPoint)
    {
         return response()->view('', compact('orderPoint'));
    }

    public function edit(OrderPoint $orderPoint){


         return response()->view('', compact('orderPoint'));

    }

    public function update(UpdateOrderPointRequest $request, OrderPoint $orderPoint)
    {
        $orderPoint->update($request->validated());

         return response()->json(['message' => $orderPoint ? 'Updated Successfully' : 'Failed To Updated'], $orderPoint ?Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function destroy(Request $request,OrderPoint $orderPoint)
    {
        $deleted = $orderPoint->delete();

        if ($deleted) {
            return response()->json(['title' => 'Deleted!', 'message' => ' Deleted Successfully', 'icon' => 'success'], Response::HTTP_OK);
        } else {
            return response()->json(['title' => 'Failed!', 'message' => 'Delete Failed', 'icon' => 'error'],  Response::HTTP_BAD_REQUEST);
        }
    }
}
