<?php

namespace App\Zoom;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class Zoom implements ZoomInterface
{
    use ZoomTrait;

    /**
     * Get the list of created meeting
     * 
     */
    public function meetings()
    {
        $client = new Client(['base_uri' => $this->base_url]);

        $response = $client->request('GET', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer " . $this->getAccessToken()
            ]
        ]);

        return json_decode($response->getBody());
    }


    /**
     * Get the meetings by our appication users
     * 
     * @param object $meetings
     */
    public function meetingsListByHost(object $meetings)
    {
        $meetings->map(function ($data) {
            foreach ($this->meetings()->meetings as $item) {
                if ($item->id == $data->meeting_id) {
                    array_push($this->meetingListByHost, [
                        'meeting_id' => $data->meeting_id,
                        'topic' => $item->topic,
                        'password' => $data->password,
                        'start_url' => $data->start_url,
                        'join_url' => $item->join_url,
                        'date' => $data->getUserDate(),
                        'time' => $data->getUserTime()
                    ]);
                }
            }
        });

        return $this->meetingListByHost;
    }


    /**
     * Get past meeting participants
     * 
     * This is a paid feature
     */
    public function getParticipants($meeting_id)
    {
    }


    /**
     * Create a zoom meeting
     * 
     */
    public function create($request)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->base_url,
        ]);

        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer " . $this->getAccessToken()
            ],
            'json' => [
                "topic" => $request->topic,
                "type" => 2,
                "start_time" => $this->getZoomDateTimeFormat($request->datetime),
                "duration" => "30", // 30 mins
                "password" => Str::random(8)
            ],
        ]);

        return json_decode($response->getBody());
    }


    /**
     * Update an existing zoom meeting
     * 
     */
    public function update($meeting_id)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->base_url,
        ]);

        $response = $client->request('PATCH', '/v2/meetings/' . $meeting_id, [
            "headers" => [
                "Authorization" => "Bearer " . $this->getAccessToken()
            ],
            'json' => [
                "topic" => "Let's Learn Laravel",
                "type" => 2,
                "start_time" => "2021-07-20T10:30:00",
                "duration" => "45", // 45 mins
                "password" => "123456"
            ],
        ]);

        return $response;
    }


    /**
     * Destroy an existing meeting
     * 
     */
    public function destroy($meeting_id)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->base_url,
        ]);

        $response = $client->request("DELETE", "/v2/meetings/{$meeting_id}", [
            "headers" => [
                "Authorization" => "Bearer " . $this->getAccessToken()
            ]
        ]);
        return $response;
    }
}
