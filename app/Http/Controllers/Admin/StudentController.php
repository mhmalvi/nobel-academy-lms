<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Str;
use App\Exceptions\AppExceptions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $students = Student::orderBy('created_at', 'desc')->get();
        return view('admin.students.index', compact('students'));
    }



    /**
     * 
     */
    public function create(){ 
        return view('admin.students.create');
    }

    

    /**
     * 
     */
    public function store(CreateUserRequest $request){
        try {
            $file = null;

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
    
                $file = date('dmy-hms').'.'.$imgExtension;
    
                //Store the file after saving it to the databse
                Storage::putFileAs('public/users', $image, $file);
            }
    
            $data = [
                'action_user' => Auth::id(),
                'name' => Str::ucfirst($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'photo' => $file,
                'user_type' => 'student',
                'action_user' => Auth::id()
            ];

            $user = User::create($data);

            if($user->id){
                $student = Student::create([
                    'action_user' => Auth::id(),
                    'user_id' => $user->id,
                    'first_name' => Str::ucfirst($request->fName),
                    'last_name' => Str::ucfirst($request->lName),
                    'phone' => $request->phone,
                    'mobile' => $request->mobile,
                    'address_one' => $request->address,
                    'address_two' => $request->address_op,
                    'is_enrolled' => 'y'
                ]);

                if($student->id){
                    /**
                     * retun successfull notification
                     */
                    $notification = [
                        'message'   =>  "successfully saved",
                        'alert-type'    =>  'success'
                    ];
            
                    return redirect()->back()->with($notification);
                }
                else{
                /**
                 * Throw an exception if request cannot be processed
                 */
                throw new Exception("Error Processing Request", 1);
                }
            }
            else{
                /**
                 * Throw an exception if request cannot be processed
                 */
                throw new Exception("Error Processing Request", 1);
            }

        } catch (\Throwable $th) {
            /**
             * Return the exceptions
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }
}
