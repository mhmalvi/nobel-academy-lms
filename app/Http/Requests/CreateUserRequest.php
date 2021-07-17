<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\UserInfo;

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
            'avatar' => [
                'image',
                Rule::dimensions()->maxWidth(300)->maxHeight(300)->ratio(1 / 1),
                'max:1048'
            ],
        ];
    }


    /**
     * Store User
     */
    public function store()
    {
        return
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'photo' => ($this->hasFile('avatar')) ? $this->avater($this->file('avatar')) : null,
                'user_type' => $this->user_type,
            ]);
    }


    /**
     * Store Avater
     */
    public function avater($avater)
    {
        /**
         * Check if derectory exist or not
         * Create a new directory if not exist
         */
        if (!Storage::exists("public/users")) {
            Storage::makeDirectory("public/users");
        }

        $image = $avater;
        $imgExtension = $image->getClientOriginalExtension();

        $file = date('dmy-hms') . '.' . $imgExtension;

        //Store the file after saving it to the databse
        Storage::putFileAs('public/users', $image, $file);

        return $file;
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
