<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\AppExceptions;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * This will return the user profile setting view
     */
    public function profileSettings(){
        return view('admin.settings.profile');
    }


    /**
     * 
     */
    public function notice(){
        $notices = DB::table('announcements')->join('announcement_files','announcements.id', '=', 'announcement_files.announcement_id')->get();
        return view('admin.others.manage-notices', compact('notices'));
    }



    /**
     * This will return the create announcement view
     */
    public function noticeCreate(){
        return view('admin.others.notice');
    }

    
    /**
     * Update user profile
     */
    public function profileUpdate(Request $request){
        try {
            $data = User::firstWhere('id', Auth::id());

            $data->name = $request->username;
            $data->email = $request->email;

            if($request->hasFile('file')){
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

                $file = Auth::user()->name.'.'.$imgExtension;

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
    public function noticeStore(AnnouncementRequest $request){
        try {
            /**
             * Checking if incoming request has subject
             * else throw an exception
             */
            if($request->has('subject')){
                $data = [
                    'action_user' => Auth::id(),
                    'subject' => $request->subject,
                    'text' => $request->descriptions,
                    'is_approved' => 'y',
                    'approved_by' => Auth::id()
                ];

                $notice = Announcement::create($data);


                /**
                 * if request contain a file to upload
                 */
                if($request->hasFile('file') && $notice->id){
                    $file = $request->file('file');
                    /**
                     * Get the file name without extension
                     */
                    $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                    //get the file extension
                    $extension = $file->getClientOriginalExtension();

                    $date = date('dmy');

                    //create a new file name
                    $filename = "{$name}_{$date}.{$extension}";

                    /**
                     * store the image/file to the database
                     */
                    DB::table('announcement_files')->insert([
                        'announcement_id' => $notice->id,
                        'file_name' => $filename,
                        'file_path' => storage_path('public/announcements'.$filename),
                        'file_ext' => $extension,
                        'file_meta_data' => null,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString()
                    ]);

                    /**
                    * Check if derectory exist or not
                    * Create a new directory if not exist
                    */
                    if (!Storage::exists("public/announcements")) {
                    Storage::makeDirectory("public/announcements");
                    }

                    //Store the file after saving it to the databse
                    Storage::putFileAs('public/announcements', $file, $filename);
                }


                /**
                 * retun successfull notification
                 */
                $notification = [
                    'message'   =>  "successfully saved",
                    'alert-type'    =>  'success'
                ];
        
                return redirect()->back()->with($notification);

            }else{
                /**
                 * Throw an exception if request cannot be processed
                 */
                throw new Exception("Error Processing Request", 1);
            }

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
    public function events(){
        return view('admin.others.events');
    }
}
