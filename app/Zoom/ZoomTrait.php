<?php

namespace App\Zoom;

use \Firebase\JWT\JWT;

trait ZoomTrait
{
    protected $key;
    protected $secret;
    protected $base_url;
    protected $email;
    protected $date;
    public $meetingListByHost;


    public function __construct()
    {
        $this->key = config('zoom.key');
        $this->secret = config('zoom.secret');
        $this->base_url = config('zoom.base_url');
        $this->email = config('zoom.email');
        $this->meetingListByHost = [];
    }


    protected function getAccessToken()
    {
        $key = $this->secret;
        $payload = array(
            "iss" => $this->key,
            'exp' => time() + 3600,
        );
        return JWT::encode($payload, $key);
    }


    protected function getZoomDateTimeFormat(string $dateTime)
    {
        try {
            $dateTime = new \DateTime($dateTime);
            $date = $dateTime->format('Y-m-d');
            $time = $dateTime->format('H:i:s');

            return "{$date}T{$time}";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function getDbTimeStamp(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);

            return $date->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
