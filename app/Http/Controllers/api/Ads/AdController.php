<?php

namespace App\Http\Controllers\api\Ads;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdController extends Controller
{
    public function index(Request $request)
    {
        $ad= Ad::orderBy('id', 'desc')->get();
        if($ad){
            return $ad;
        }else{
            return response()->json([
                'status' => false,
                'message' => Messages::getMessage('NOT_FOUND')
            ], Response::HTTP_NOT_FOUND);
        }


    }



}
