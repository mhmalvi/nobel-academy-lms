<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Support\AppCryption;

class Enrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'core_units' => 'array',
        'elective_units' => 'array',
    ];


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
     * Action User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'action_user');
    }

    /**
     * 
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
