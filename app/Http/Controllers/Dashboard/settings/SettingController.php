<?php

namespace App\Http\Controllers\Dashboard\settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\TermsRequest;
use App\Models\Setting;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{

    public function index()
    {
        $settings = Setting::all();
        return response()->view('dashboard.settings.index',compact('settings'));
    }


    public function create()
    {
        return response()->view('dashboard.settings.create');
    }


    public function store(SettingRequest $request)
    {

        $setting = new Setting();
        $setting->key = $request->input('key');
        $setting->value = $request->input('value');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Carbon::now()->format('Y_m_d_h_i_s') . '_' . $setting->key . '.' . $image->getClientOriginalExtension();
            $request->file('image')->storeAs('/settings', $imageName, ['disk' => 'public']);
            $setting->value = 'settings/' . $imageName;
        }
        $isSaved = $setting->save();

        return response()->json([
            'message' => $isSaved ? 'تم الانشاء بنجاح' : 'فشل الانشاء'
        ],$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }



    public function edit(Setting $setting)
    {
        return response()->view('dashboard.settings.edit',compact('setting'));
    }


    public function update(SettingRequest $request, Setting $setting)
    {
        $setting->key = $request->input('key');
        $setting->value = $request->input('value');


        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($setting->image);
            $image = $request->file('image');
            $imageName = Carbon::now()->format('Y_m_d_h_i_s') . '_' . $setting->key . '.' . $image->getClientOriginalExtension();
            $request->file('image')->storeAs('/settings', $imageName, ['disk' => 'public']);
            $setting->value = 'settings/' . $imageName;
        }
        $isSaved = $setting->update();

        return response()->json([
            'message' => $isSaved ? 'تم التحديث بنجاح' : 'فشل التحديث'
        ],$isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }


    public function destroy(Setting $setting)
    {

        $imageName = $setting->value;
        $deleted = $setting->delete();
        if ($deleted) Storage::disk('public')->delete($imageName);
        return response()->json([
            'title' => $deleted ? 'تم الحذف بنجاح' : "فشل الحذف",
            'icon' => $deleted ? 'success' : "error",
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
