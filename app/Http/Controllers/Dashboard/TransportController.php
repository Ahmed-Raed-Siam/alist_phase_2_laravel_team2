<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransportsRequest;
use App\Models\Transport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $transports = Transport::all();
        return response()->view('dashboard.transport.index', [
            'transport' => $transports,
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

        return response()->view('dashboard.transport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransportsRequest $request)
    {
        //

        $transport = new Transport();
        $transport->driver_name = $request->input('driver_name');
        $transport->vehicle_type = $request->input('vehicle_type');
        $transport->plate_number = $request->input('plate_number');

        if ($request->hasFile('driver_image')) {
            $image = $request->file('driver_image');
            $imageName =
                Carbon::now()->format('Y_m_d_h_i') .
                '.' .
                $image->getClientOriginalExtension();
            $request
                ->file('driver_image')
                ->storeAs('/transports', $imageName, ['disk' => 'public']);
            $transport->driver_image = 'transports/' . $imageName;
        }

        $isSaved = $transport->save();

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
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $transport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport $transport)
    {
        //

        return response()->view(
            'dashboard.transport.edit',
            compact('transport')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function update(TransportsRequest $request, Transport $transport)
    {
        //
        $transport->driver_name = $request->input('driver_name');
        $transport->vehicle_type = $request->input('vehicle_type');
        $transport->plate_number = $request->input('plate_number');
        if ($request->hasFile('driver_image')) {
            Storage::disk('public')->delete($transport->driver_image);
            $image = $request->file('driver_image');
            $imageName =
                Carbon::now()->format('Y_m_d_h_i') .
                '.' .
                $image->getClientOriginalExtension();
            $request
                ->file('driver_image')
                ->storeAs('/transports', $imageName, ['disk' => 'public']);
            $transport->driver_image = 'transports/' . $imageName;
        }

        $isUpdated = $transport->update();

        return response()->json([
            'message' => $isUpdated ? 'تم التعديل بنجاح' : 'فشل التعديل'
        ],$isUpdated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);    }

    /**     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport $transport)
    {
        $imageName = $transport->image;
        $isDeleted = $transport->delete();
        if ($isDeleted) Storage::disk('public')->delete($imageName);
        return response()->json([
            'title' => $isDeleted ? 'تم الحذف بنجاح' : "فشل الحذف",
            'icon' => $isDeleted ? 'success' : "error",
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
