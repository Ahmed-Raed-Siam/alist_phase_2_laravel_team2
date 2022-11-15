<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\AdRequest;
use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class AdController extends Controller
{

    public function index()
    {
        $ads = Ad::all();
        return response()->view('dashboard.ads.index',compact('ads'));
    }


    public function create()
    {
        return response()->view('dashboard.ads.create');
    }


    public function store(AdRequest $request)
    {
        $ad = new Ad();
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->link = $request->input('link');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Carbon::now()->format('Y_m_d_h_i_s') . '_' . $ad->title . '.' . $image->getClientOriginalExtension();
            $request->file('image')->storeAs('/ads', $imageName, ['disk' => 'public']);
            $ad->image = 'ads/' . $imageName;
        }
        $isSaved = $ad->save();

        return response()->json([
            'message' => $isSaved ? 'تم الانشاء بنجاح' : 'فشل الانشاء'
        ],$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }


    public function show(Ad $ad)
    {
        //
    }


    public function edit(Ad $ad)
    {
        return response()->view('dashboard.ads.edit',compact('ad'));
    }


    public function update(Request $request, Ad $ad)
    {
        $ad->title = $request->input('title');
        $ad->description = $request->input('description');
        $ad->link = $request->input('link');


        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($ad->image);
            $image = $request->file('image');
            $imageName = Carbon::now()->format('Y_m_d_h_i_s') . '_' . $ad->title . '.' . $image->getClientOriginalExtension();
            $request->file('image')->storeAs('/ads', $imageName, ['disk' => 'public']);
            $ad->image = 'ads/' . $imageName;
        }
        $isSaved = $ad->update();

        return response()->json([
            'message' => $isSaved ? 'تم التحديث بنجاح' : 'فشل التحديث'
        ],$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }


    public function destroy(Ad $ad)
    {
        $imageName = $ad->image;
        $deleted = $ad->delete();
        if ($deleted) Storage::disk('public')->delete($imageName);
        return response()->json([
            'title' => $deleted ? 'تم الحذف بنجاح' : "فشل الحذف",
            'icon' => $deleted ? 'success' : "error",
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
