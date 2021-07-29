<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\AppCryption;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Encrypt uuid
     */
    public function setUuidAttribute($value)
    {
        $this->attributes['uuid'] = AppCryption::encrypt($value);
    }

    /**
     * Encrypt uuid
     */
    public function getUuidAttribute($value)
    {
        return AppCryption::decrypt($value);
    }


    /**
     * 
     */
    public function getCreatedAtAttribute($value)
    {
        $timestamp = strtotime($value);

        $strTime = array("second", "minutes", "hours", "days", "months", "years");
        $length = array("60", "60", "24", "30", "12", "10");

        $currentTime = time();
        if ($currentTime >= $timestamp) {
            $diff     = time() - $timestamp;
            for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . " ago ";
        }

        return false;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(PostFile::class);
    }
}
