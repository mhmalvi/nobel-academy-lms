<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeetingCreateRequest;
use App\Models\ZoomMeeting;
use Illuminate\Http\Request;
use App\Zoom\Zoom;
use Illuminate\Support\Facades\Auth;

class ZoomAppController extends Controller
{
    protected $zoom;

    public function __construct(Zoom $zoom)
    {
        $this->zoom = $zoom;
    }

    public function index()
    {
        $list = $this->zoom->meetingsListByHost(ZoomMeeting::where('host_id', Auth::id())->get());
        return view('pages.meetings', compact('list'));
    }


    /**
     * 
     */
    public function createMeeting(MeetingCreateRequest $request)
    {
        try {
            $request->store($this->zoom);

            return back();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function destroy($id)
    {
        try {
            $response = $this->zoom->destroy($id);

            ZoomMeeting::where('meeting_id', $id)->delete();

            if ($response->getStatusCode() == 204) {
                return back();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
