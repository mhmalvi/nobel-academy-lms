<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CourseCategory;
use App\Models\Enrollment;
use App\Models\CourseUnit;
use App\Support\AppCryption;
use App\Models\User;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['action_user'];

    protected $guarded = [];


    /**
     * Attributr that should be casts
     */
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];

    public function getCourseCategoryIdAttribute($value)
    {
        if (is_null($value)) {
            return 'Uncategorized';
        }

        return AppCryption::encrypt($value);
    }


    public function getCreatedAtAttribute($value)
    {
        return date("M d, Y", strtotime($value));
    }


    public function course()
    {
        return "{$this->course_code} - {$this->course_name}";
    }

    /**
     * Each course belongs to atleast one category
     */
    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }


    /**
     * A course have many units
     */
    public function units()
    {
        return $this->hasMany(CourseUnit::class);
    }


    /**
     * A course may have many enrollment
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }


    /**
     * A course may have many teachers
     */
    public function courseTeacher()
    {
        return $this->belongsToMany(User::class, 'teachers', 'user_id', 'course_id');
    }


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'course_code';
    }
}
