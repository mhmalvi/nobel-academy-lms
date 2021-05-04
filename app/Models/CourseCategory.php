<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Course;
use App\Support\AppCryption;

class CourseCategory extends Model
{
    use HasFactory;

    protected $hidden = ['id'];

    protected $fillable = ['uuid', 'action_user', 'category_code', 'category_name', 'descriptions'];


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
    public function setCategoryNameAttribute($value)
    {
        $this->attributes['category_name'] = ucfirst($value);
    }


    /**
     * Format Datetime
     */
    public function getCreatedAtAttribute($value)
    {
        return date("M d, Y", strtotime($value));
    }


    /**
     * 
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'action_user');
    }


    /**
     * 
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
