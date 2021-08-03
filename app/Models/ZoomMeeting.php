<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getScheduleAttribute($value)
    {
        return date("M d, Y H:i:s", strtotime($value));
    }
}
