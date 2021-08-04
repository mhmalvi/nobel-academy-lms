<?php

namespace App\Http\Requests;

use App\Models\ZoomMeeting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MeetingCreateRequest extends FormRequest
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
            'topic' => 'required|string|max:255',
            'datetime' => 'required'
        ];
    }


    /**
     * Create and store the meeting cred
     */
    public function store($zoom)
    {
        $meeting = $zoom->create($this);

        $meeting_id = "{$meeting->id}";

        ZoomMeeting::create([
            'host_id' => Auth::id(),
            'meeting_id' => $meeting_id,
            'start_url' => $meeting->start_url,
            'schedule' => $zoom->getDbTimeStamp($this->datetime),
            'password' => $meeting->password
        ]);
    }
}
