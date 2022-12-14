<?php

namespace App\Http\Controllers\api;

use App\Helpers\Messages;
use App\Http\Controllers\Controller;
use App\Models\Broker;
use App\Models\CustomerManagment;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AuthController extends Controller
{


    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:45',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->address = $request->input('address');
            $user->birth_day = $request->input('birth_day');
            // $user->gender = $request->input('gender');
            $user->password = Hash::make($request->input('password'));
            $isSaved = $user->save();
            $token = $user->createToken('authToken')->plainTextToken;
            $customer = new CustomerManagment();
            $customer->user_id = $user->id ;
            $customer->address = $request->input('address');
            $customer->mobile = $request->input('mobile');
            $customer->email= $request->input('email');
            $customer->save();



            return response()->json([
                'token' => $token,

            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function login(Request $request){
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => '?????????? '.$user->name.', ???????? ?????? ???? ???????? ??????????????  ','access_token' => $token, 'token_type' => 'Bearer', ]);
        }
    public function forgetPassword(Request $request)
    {
        $validator  = Validator($request->all(), [
            'email' =>'required|email|exists:users,email',
        ]);
        if(!$validator->fails()) {
            $user = User::where('email',$request->input('email'))->first();
            $authCode = random_int(1000,9999); // 4  digit code
            $user->auth_code = Hash::make($authCode);
            $isSaved = $user->save();
            return response()->json(
                [
                'status' =>$isSaved,
                'message' => $isSaved ? 'Reset code sent successfully' :' Failed to send reset code !',
                'code'   => $authCode,// just for test
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );


        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator($request->all(), [
            'email' => 'required|email|exists:users,email',
            'auth_code' => 'required|numeric|digits:4',
            'password' => 'required|string|min:3|max:15|confirmed'
        ]);

        if (!$validator->fails()) {
            $user = User::where('email', '=', $request->input('email'))->first();
            if (!is_null($user->auth_code)) {
                if (Hash::check($request->input('auth_code'), $user->auth_code)) {
                    $user->password = Hash::make($request->input('password'));
                    $user->auth_code = null;
                    $isSaved = $user->save();
                    return response()->json(
                        [
                            'status' => $isSaved,
                            'message' => Messages::getMessage($isSaved ? 'RESET_PASSWORD_SUCCESS' : 'RESET_PASSWORD_FAILED'),
                        ],
                        $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
                    );
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => Messages::getMessage('AUTH_CODE_ERROR')
                    ], Response::HTTP_BAD_REQUEST);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => Messages::getMessage('NO_PASSWORD_RESET_CODE')
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function logout(Request $request){

        $user = Auth::guard('sanctum')->user();

        $user->currentAccessToken()->delete();

        return Response::json([
            'message' => 'token deleted '
        ],401 );

    }


}
