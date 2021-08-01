<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class ProfileController extends Controller
{
    public function updateBasicInfo(Request $request)
    {
        try {
            $user = User::findOrFail(Auth::id());
            $userInfo = UserInfo::where('user_id', Auth::id())->first();

            $user->name = $request->name;
            $userInfo->firstname = $request->firstname;
            $userInfo->lastname = $request->lastname;
            $userInfo->phone = $request->phone;
            $userInfo->address = $request->address;

            $user->save();
            $userInfo->save();

            return response()->json(['msg' => 'Saved successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    public function updateProfilePicture(Request $request)
    {
        $validated = $request->validate([
            'avatar' => 'required'
        ]);
        try {
            if ($validated) {
                $user = User::findOrFail(Auth::id());
                $avatar = $request->file('avatar');
                Storage::delete('public/users/' . $user->photo);

                $resize = Image::make($avatar)->fit(300)->encode('jpg');
                $hash = md5($resize->__toString());
                $name = "{$hash}.jpg";
                $user->photo = $name;
                Storage::put('public/users/' . $name, $resize->__toString());
                $user->save();

                return response()->json(['msg' => 'Saved successfully'], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
