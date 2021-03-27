<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\AppExceptions;

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
        try {
            if(Auth::user()->user_type == 'student'){
                $user = User::with('student')->where('id', Auth::id())->first();
                $user->name = $request->name;
                $user->student->first_name = $request->fname;
                $user->student->last_name = $request->lname;
                $user->student->phone = $request->phone;
                $user->student->mobile = $request->mobile;
                $user->student->address_one = $request->addressOne;
                $user->student->address_two = $request->addressTwo;
                $user->save();
                $user->student->save();
            }
            elseif (Auth::user()->user_type == 'teacher') {
                $user = User::with('teacher')->where('id', Auth::id())->first();
                $user->name = $request->name;
                $user->teacher->first_name = $request->fname;
                $user->teacher->last_name = $request->lname;
                $user->teacher->phone = $request->phone;
                $user->teacher->mobile = $request->mobile;
                $user->teacher->address_one = $request->addressOne;
                $user->teacher->address_two = $request->addressTwo;
                $user->save();
                $user->teacher->save();
            }
    
            if($request->hasFile('avatar')){
                /**
                 * Check if derectory exist or not
                 * Create a new directory if not exist
                 */
                if (!Storage::exists("public/users")) {
                    Storage::makeDirectory("public/users");
                }
    
                $image = $request->file('avatar');
                $imgExtension = $image->getClientOriginalExtension();
    
                $file = uniqid().'-'.now()->timestamp.'.'.$imgExtension;
    
                //Store the file after saving it to the databse
                Storage::delete("public/users/".$user->photo);
                Storage::putFileAs('public/users', $image, $file);
    
                $user->photo = $file;
                $user->save();
            }
    
            if($request->has('npass') && $user->password == Hash::make($request->opass)){
                $user->password = Hash::make($request->npass);
                $user->save();
            }
    
            $notification = [
                'message'   =>  "Your profile updated successfully",
                'alert-type'    =>  'success'
            ];
    
            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            /**
             * Return the exceptions
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }
}
