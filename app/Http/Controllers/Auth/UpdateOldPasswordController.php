<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOldPassword;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateOldPasswordController extends Controller
{
    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UpdateOldPassword $request)
    {
        try {
            $user = User::findOrFail(Auth::id());

            $user->password = $request->password;

            $user->save();

            return response()->json(['msg' => 'Password updated successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }
}
