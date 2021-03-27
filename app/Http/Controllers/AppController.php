<?php

namespace App\Http\Controllers;

use App\Models\TempUserPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Inline\Element\Strong;

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

            //Store the file after saving it to the database
            $tmpFile = TempUserPhoto::where('foldername', $request->image)->first();

            $file = Storage::files('public/users/'.$tmpFile->foldername);

            if (Storage::disk('local')->exists($tmpFile->filename)) {
                dd($file);
            }else{
                echo "n";
            }
        }
    }
}
