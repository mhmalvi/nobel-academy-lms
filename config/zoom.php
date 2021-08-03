<?php

/**
 * ----------------------------------------------------------------
 * ZOOM MEETING CONFIGURATIONS
 * ----------------------------------------------------------------
 * 
 * 
 * 
 */

return [
    /**
     * The app api key
     * 
     */
    'key' => env('ZOOM_API_KEY', ''),


    /**
     * App secret key
     * 
     */
    'secret' => env('ZOOM_APP_SECRET', ''),


    /**
     * The base url to interect with zoom app
     * 
     */
    'base_url' => env('ZOOM_BASE_URL', ''),


    /**
     * The email address that we have used
     * to create a zoom account
     * 
     */
    'email' => env('ZOOM_USER_EMAIL', '')
];
