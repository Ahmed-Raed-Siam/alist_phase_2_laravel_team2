<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePointsTransferRequest;
use App\Http\Requests\UpdatePointsTransferRequest;
use App\Models\CustomerManagment;
use App\Models\PointsTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;


class PointsTransferController extends Controller
{

    public function __construct(Request $request){
        // parent::__construct($request);
        // $this->authorizeResource(PointsTransfer::class,Str::snake("PointsTransfer"));
    }

    public function index(Request $request)
    {
        $items = PointsTransfer::with(['point_from_customer' , 'point_to_customer'])->search($request)->sort($request)->paginate(15);

        return response()->view('dashboard.point_management.tranfers.index', compact('items'));

    }

    public function create (){

         return response()->view('');

    }

    public function store(StorePointsTransferRequest $request)
    {
        $pointsTransfer = PointsTransfer::create(  $request->validated());

          return response()->json(['message' => $pointsTransfer ? 'Created Successfully' : 'Failed To Create'], $pointsTransfer ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }


    public function show(Request $request,PointsTransfer $pointsTransfer)
    {
         return response()->view('', compact('pointsTransfer'));
    }

    public function edit(PointsTransfer $pointsTransfer){


         return response()->view('', compact('pointsTransfer'));

    }

    public function update(UpdatePointsTransferRequest $request, PointsTransfer $pointsTransfer)
    {
        $pointsTransfer->update($request->validated());

         return response()->json(['message' => $pointsTransfer ? 'Updated Successfully' : 'Failed To Updated'], $pointsTransfer ?Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function destroy(Request $request,PointsTransfer $pointsTransfer)
    {
        $deleted = $pointsTransfer->delete();

        if ($deleted) {
            return response()->json(['title' => 'Deleted!', 'message' => ' Deleted Successfully', 'icon' => 'success'], Response::HTTP_OK);
        } else {
            return response()->json(['title' => 'Failed!', 'message' => 'Delete Failed', 'icon' => 'error'],  Response::HTTP_BAD_REQUEST);
        }
    }


    public function deleteMany(Request $request)
    {

        $deleted = PointsTransfer::whereIn('id',$request->ids)->delete();
        if ($deleted) {
            return response()->json(['title' => 'تم الحذف!', 'message' => ' تمت العملية بنجاح', 'icon' => 'success'], Response::HTTP_OK);
        } else {
            return response()->json(['title' => 'فشل!', 'message' => 'فشلت العملية', 'icon' => 'error'],  Response::HTTP_BAD_REQUEST);
        }
    }

}
