<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\CourseCategory;
use App\Models\Enrollment;
use App\Models\CoursesTeacher;
use App\Models\CourseUnit;
use App\Support\AppCryption;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['action_user'];

    protected $fillable = [
        'action_user',
        'course_code',
        'course_name',
        'course_category_id',
        'course_units',
        'descriptions',
        'is_published',
        'total_enrolled',
        'total_teachers',
        'total_files',
        'course_thumbnail'
    ];


    /**
     * Attributr that should be casts
     */
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];

    public function getCourseCategoryIdAttribute($value){
        if(is_null($value)){
            return 'Uncategorized';
        }

        return AppCryption::encrypt($value);
    }


    public function getCreatedAtAttribute($value){
        return date("M d, Y", strtotime($value));
    }


    /**
     * Each course is cretaed by one user
     */
    public function user(){
        return $this->belongsTo(User::class, 'action_user');
    }


    /**
     * Each course belongs to atleast one category
     */
    public function category(){
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }


    /**
     * A course have many units
     */
    public function units(){
        return $this->hasMany(CourseUnit::class);
    }


    /**
     * A course may have many enrollment
     */
    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }


    /**
     * A course may have many teachers
     */
    public function teachers(){
        return $this->hasMany(CoursesTeacher::class);
    }
}
