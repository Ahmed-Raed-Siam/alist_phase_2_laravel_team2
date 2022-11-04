<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\MessageBag;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    //
    public function showLogin()
     {
        return response()->view('dashboard.auth.login');
    }
    public function login(AdminLoginRequest $request)
    {
    

            $credentials = ['email' => $request->input('email'), 'password' => $request->input('password')];
            if (Auth::guard('admin')->attempt($credentials )) {
                return response()->json([
                    'message' => 'Logged in successfully'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => "خطاء في بيانات رجاء محاولة مجددا"
                ], Response::HTTP_BAD_REQUEST);
            }


    }



    public function logout(Request $request)
    {
        //auth('admin')->logout();
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login-show');

    }
}
