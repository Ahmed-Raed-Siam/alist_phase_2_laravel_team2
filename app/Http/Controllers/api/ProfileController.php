<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Sanctum\PersonalAccessToken;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $user = auth('sanctum')->user();
        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user = auth('sanctum')->user();
        return $user ;
        $validator = Validator($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'birth_day' => 'required',
            'gender' => 'required',
        ]);

        if (!$validator->fails()) {
            $previous = false;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $user->image = $file->store('/images', [
                    'disk' => 'uploads'
                ]);
                $previous = $user->image;
            }
            if ($previous) {
                Storage::disk('uploads')->delete($previous);
            }
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');
            $user->birth_day = $request->input('birth_day');
            $user->gender = $request->input('gender');
            $user->password = Hash::make($request->input('password'));
            $isSaved = $user->save();

            return response()->json([
                'message' => $isSaved ? 'updated successfully' : ' Failed to update !',
                'code' => 200,
                'status' => true,
                'profile' => $user,

            ]);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
