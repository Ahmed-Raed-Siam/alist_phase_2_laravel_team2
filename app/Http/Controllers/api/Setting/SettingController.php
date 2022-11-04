<?php

namespace App\Http\Controllers\api\Setting;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Http\Resources\Settings\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $terms= Setting::where('key','terms')->orWhere('key','background_terms')->get();
        if($terms){
            return  SettingResource::collection($terms);
        }else{
            return response()->json([
                'status' => false,
                'message' => Messages::getMessage('NOT_FOUND')
            ], Response::HTTP_NOT_FOUND);
        }


    }
}
