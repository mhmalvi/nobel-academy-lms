<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\UserInfo;
use Illuminate\Support\Str;
use Image;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8|max:20',
            'fName' => 'required',
            'lName' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'user_type' => 'required',
            'avatar' => 'image',
            'class_id' => 'exclude_unless:user_type,student|required'
        ];
    }


    /**
     * Store User
     */
    public function store()
    {
        return
            User::create([
                'uuid' => Str::random(8),
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'photo' => ($this->hasFile('avatar')) ? $this->avatar($this->file('avatar')) : null,
                'user_type' => $this->user_type,
                'classroom_id' => $this->class_id
            ]);
    }


    /**
     * Store Avater
     */
    public function avatar($avatar)
    {
        /**
         * Check if derectory exist or not
         * Create a new directory if not exist
         */
        if (!Storage::exists("public/users")) {
            Storage::makeDirectory("public/users");
        }

        $resize = Image::make($avatar)->fit(300)->encode('jpg');
        $hash = md5($resize->__toString());
        $name = "{$hash}.jpg";

        Storage::put('public/users/' . $name, $resize->__toString());

        return $name;
    }


    public function saveInfo($user)
    {
        UserInfo::create([
            'user_id' => $user->id,
            'firstname' => $this->fName,
            'lastname' => $this->lName,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);
    }
}
