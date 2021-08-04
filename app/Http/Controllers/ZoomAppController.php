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


    /**
     * 
     */
    public function index()
    {
        return view('pages.meetings');
    }


    /**
     * 
     */
    public function getList()
    {
        try {
            $list = $this->zoom->meetingsListByHost(ZoomMeeting::where('host_id', Auth::id())->orderBy('schedule', 'asc')->get());

            return response()->json($list, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    /**
     * 
     */
    public function createMeeting(MeetingCreateRequest $request)
    {
        try {
            $request->store($this->zoom);

            return response()->json(['status' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    /**
     * 
     */
    public function destroy($id)
    {
        try {
            $response = $this->zoom->destroy($id);

            ZoomMeeting::where('meeting_id', $id)->delete();

            return response($response->getStatusCode());
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
