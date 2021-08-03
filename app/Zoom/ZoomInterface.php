<?php

namespace App\Zoom;

interface ZoomInterface
{
    /**
     * get the list of meetings
     * 
     */
    public function meetings();


    /**
     * Get meetings by host from application
     */
    public function meetingsListByHost(object $meetings);


    /**
     * Get meeting participants
     * 
     */
    public function getParticipants($meeting_id);

    /**
     * Create a new zoom meeting
     * 
     */
    public function create($request);


    /**
     * Update an existing meeting
     * 
     */
    public function update($meeting_id);


    /**
     * Delete a meeting
     * 
     */
    public function destroy($meeting_id);
}
