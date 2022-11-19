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


        $user_id = auth('sanctum')->user()->id;
          $user = User::where('id' ,$user_id)->with('customer')->get();
        return response()->json([
            'user' => $user ,
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

        $user_id = auth('sanctum')->user()->id;;
        $user = User::find($user_id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'birth_day' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ]);
        $previous = false;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $file->store('/images/users', [
                'disk' => 'uploads'
            ]);
            $previous = $user->image;
        }
        if ($previous) {
            Storage::disk('uploads')->delete($previous);
        }
        $user->update($data);
        return response()->json(['code' => 200, 'status' => true, 'user' => $user]);

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
