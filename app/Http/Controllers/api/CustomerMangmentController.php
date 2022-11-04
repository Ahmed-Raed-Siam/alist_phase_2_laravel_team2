<?php

namespace App\Http\Controllers\api;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerManagementRequest;
use App\Http\Resources\CustomerMangmentResource;
use App\Models\CustomerManagment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMangmentController extends Controller
{
    //
    public function getCustomer()
    {
        $customers = CustomerManagment::all();

        if ($customers) {
            return CustomerMangmentResource::collection($customers);
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => Messages::getMessage('NOT_FOUND'),
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function storeCustomer(CustomerManagementRequest $request)
    {
        $image = $request->file('customer_image');
        $name = 'customer/' . uniqid() . '_' . $image->getClientOriginalName();
        $path = $request
            ->file('customer_image')
            ->storeAs('/', $name, ['disk' => 'public']);
        $arr = [
            'shop_owner_name' => $request->shop_owner_name,
            'shop_owner_name' => $request->shop_owner_name,
            'supermarket_name' => $request->supermarket_name,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'email'=>$request->email,
            'total_point' => $request->total_point,
            'customer_image' => $name,
        ];
        $customerManagment = CustomerManagment::create($arr);
        return new CustomerMangmentResource($customerManagment);

    }

    public function updateCustomer(
        CustomerManagment $customerManagment,
        CustomerManagementRequest $request
    ) {
        $image = $request->file('customer_image');
        $name = 'customer/' . uniqid() . '_' . $image->getClientOriginalName();
        $path = $request
            ->file('customer_image')
            ->storeAs('/', $name, ['disk' => 'public']);
        $arr = [
            'shop_owner_name' => $request->shop_owner_name,
            'shop_owner_name' => $request->shop_owner_name,
            'supermarket_name' => $request->supermarket_name,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'email'=>$request->email,
            'total_point' => $request->total_point,
            'customer_image' => $name,
        ];
        $customerManagment = $customerManagment->update($arr);

    }

    public function destroy(CustomerManagment $customerManagment)
    {
        $customerManagment = $customerManagment->delete();
        if($customerManagment){
            return response()->json([
                'status'=>true,
                'message' => 'The record has been deleted'
            ],Response::HTTP_OK);
        }else{
            return response()->json([
                'status'=>false,
                'message'=> 'The delete operation is failed',
            ]);
        }
        return response(null, 402);
    }
}
