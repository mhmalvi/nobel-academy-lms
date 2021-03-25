<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Exceptions\AppExceptions;
use App\Models\TempUserPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Exception;

class AppController extends Controller
{
    /**
     * Return the view for calender
     */
    public function calendar(){
        return view('calendar');
    }


    /**
     * 
     */
    public function userProfile(){
        return view('profile');
    }


    /**
     * 
     */
    public function updateProfileInfo(Request $request){
        if($request->has('image')){
            /**
             * Check if derectory exist or not
             * Create a new directory if not exist
             */
            if (!Storage::exists("public/users")) {
                Storage::makeDirectory("public/users");
            }

            //Store the file after saving it to the databse+
            Storage::move(storage_path('users/temp/'.$request->image), 'users/'.$request->image);
            TempUserPhoto::where('filename', $request->image)->delete();
        }
    }
}
