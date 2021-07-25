<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
