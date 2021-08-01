<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementRequest extends FormRequest
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
            'subject' => 'required|max:255',
            'descriptions' => 'required',
            'file' => 'image|mimes:png,jpg,jpeg|max:1048'
        ];
    }


    public function save()
    {
        $notice = Announcement::create(
            [
                'subject' => $this->subject,
                'text' => $this->descriptions,
                'is_approved' => 'y',
                'approved_by' => Auth::id(),
                'thumbnail' => $this->hasFile('file') ? $this->saveFile() : null
            ]
        );

        return $notice;
    }


    public function saveFile()
    {
        $file = $this->file('file');
        $name = $file->getClientOriginalName();

        if (!Storage::exists("public/notices")) {
            Storage::makeDirectory("public/notices");
        }

        Storage::putFileAs('public/notices', $file, $name);

        return $name;
    }
}
