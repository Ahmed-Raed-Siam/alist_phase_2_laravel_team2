<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryManagementRequest;
use App\Http\Requests\UpdateDeliveryManagementRequest;
use App\Http\Resources\DeliveryManagementResource;
use App\Models\DeliveryManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{


    public function __construct(Request $request)
    {
        // parent::__construct($request);
        // $this->authorizeResource(DeliveryManagement::class,Str::snake("DeliveryManagement"));
    }
    public function index(Request $request)
    {
        return DeliveryManagementResource::collection(DeliveryManagement::search($request)->sort($request)->paginate((request('per_page') ?? request('itemsPerPage')) ?? 15));
    }
    public function store(StoreDeliveryManagementRequest $request)
    {
        $oreder_delivery = DeliveryManagement::create($request->validated());

        return new DeliveryManagementResource($oreder_delivery);
    }
    public function show(Request $request, DeliveryManagement $oreder_delivery)
    {

        return new DeliveryManagementResource($oreder_delivery);
    }
    public function update(UpdateDeliveryManagementRequest $request, DeliveryManagement $oreder_delivery)
    {
        $oreder_delivery->update($request->validated());

        return new DeliveryManagementResource($oreder_delivery);
    }
    public function destroy(Request $request, DeliveryManagement $oreder_delivery)
    {
        $oreder_delivery->delete();
        return new DeliveryManagementResource($oreder_delivery);
    }
}
