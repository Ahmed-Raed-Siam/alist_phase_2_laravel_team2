<?php

namespace App\Http\Controllers\api\Transports;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransportsRequest;
use App\Http\Resources\Transports\TransportResource;
use App\Models\Transport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class TransportController extends Controller
{
    //

    public function getTransport()
    {
        $transports = Transport::all();
        if ($transports) {
            return TransportResource::collection($transports);
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

    public function storeTransport(TransportsRequest $request)
    {
        $image = $request->file('driver_image');
        $name =
            'transports/' . uniqid() . '_' . $image->getClientOriginalName();
        $path = $request
            ->file('driver_image')
            ->storeAs('/', $name, ['disk' => 'public']);
        $arr = [
            'driver_name' => $request->driver_name,
            'vehicle_type' => $request->vehicle_type,
            'plate_number' => $request->plate_number,
            'driver_image' => $name,
        ];
        $transport = Transport::create($arr);
        return new TransportResource($transport);
    }

    public function updateTransport(
        TransportsRequest $request,
        Transport $transport
    ) {
        $image = $request->file('driver_image');
        $name =
            'transports/' . uniqid() . '_' . $image->getClientOriginalName();
        $path = $request
            ->file('driver_image')
            ->storeAs('/', $name, ['disk' => 'public']);

        $arr = [
            'driver_name' => $request->driver_name,
            'vehicle_type' => $request->vehicle_type,
            'plate_number' => $request->plate_number,
            'driver_image' => $name,
        ];
        $transport = $transport->update($arr);
    }

    public function destroy(Transport $transport)
    {
        $transport = $transport->delete();
        if ($transport) {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'The record has been deleted',
                ],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'The delete operation failed',
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
