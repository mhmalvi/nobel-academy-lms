<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getUserDate()
    {
        return date("M d, Y", strtotime($this->schedule));
    }


    public function getUserTime()
    {
        return date("H:i", strtotime($this->schedule));
    }
}
