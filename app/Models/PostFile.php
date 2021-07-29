<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Support\AppCryption;

class PostFile extends Model
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

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
