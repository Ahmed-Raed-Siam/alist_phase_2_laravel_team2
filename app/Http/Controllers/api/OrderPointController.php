<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderPointRequest;
use App\Http\Requests\UpdateOrderPointRequest;
use App\Http\Resources\OrderPointResource;
use App\Models\OrderPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class OrderPointController extends Controller
{


    public function __construct(Request $request){
        // parent::__construct($request);
        // $this->authorizeResource(OrderPoint::class,Str::snake("OrderPoint"));
    }
    public function index(Request $request)
    {
        return OrderPointResource::collection(OrderPoint::search($request)->sort($request)->paginate((request('per_page')??request('itemsPerPage'))??15));
    }
    public function store(StoreOrderPointRequest $request)
    {
        $orderPoint = OrderPoint::create($request->validated());
        if ($request->translations) {
            foreach ($request->translations as $translation)
                $orderPoint->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new OrderPointResource($orderPoint);
    }
    public function show(Request $request,OrderPoint $orderPoint)
    {
        return new OrderPointResource($orderPoint);
    }
    public function update(UpdateOrderPointRequest $request, OrderPoint $orderPoint)
    {
        $orderPoint->update($request->validated());
          if ($request->translations) {
            foreach ($request->translations as $translation)
                $orderPoint->setTranslation($translation['field'], $translation['locale'], $translation['value'])->save();
        }
        return new OrderPointResource($orderPoint);
    }
    public function destroy(Request $request,OrderPoint $orderPoint)
    {
        $orderPoint->delete();
        return new OrderPointResource($orderPoint);
    }
}
