<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AppExceptions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AnnouncementRequest;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * This will return the user profile setting view
     */
    public function profileSettings()
    {
        return view('admin.settings.profile');
    }


    /**
     * 
     */
    public function notice()
    {
        $notices = DB::table('announcements')->get();
        return view('admin.others.manage-notices', compact('notices'));
    }



    /**
     * This will return the create announcement view
     */
    public function noticeCreate()
    {
        return view('admin.others.notice');
    }


    /**
     * Update user profile
     */
    public function profileUpdate(Request $request)
    {
        try {
            $data = User::firstWhere('id', Auth::id());

            $data->name = $request->username;
            $data->email = $request->email;

            if ($request->hasFile('file')) {
                /**
                 * Delete old image before string the new one
                 */
                Storage::delete('public/users/' . $data->photo);

                /**
                 * Check if derectory exist or not
                 * Create a new directory if not exist
                 */
                if (!Storage::exists("public/users")) {
                    Storage::makeDirectory("public/users");
                }

                $image = $request->file('file');
                $imgExtension = $image->getClientOriginalExtension();

                $file = Auth::user()->name . '.' . $imgExtension;

                $data->photo = $file;

                //store image into storage directory
                Storage::putFileAs('public/users', $image, $file);
            }

            $data->save();


            /**
             * retun successfull notification
             */
            $notification = [
                'message'   =>  'Profile successfully updated!',
                'alert-type'    =>  'success'
            ];

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            /**
             * Return the exception
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }


    /**
     * Store announcements
     */
    public function noticeStore(AnnouncementRequest $request)
    {
        try {
            $request->save();

            $notification = [
                'message'   =>  "successfully saved",
                'alert-type'    =>  'success'
            ];

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            /**
             * Return the exception
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * 
     */
    public function events()
    {
        return view('admin.others.events');
    }
}
