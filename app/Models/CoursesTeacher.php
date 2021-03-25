<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Course;
use App\Support\AppCryption;

class CoursesTeacher extends Model
{
    use HasFactory;

    protected $fillable = ['action_user','teacher_id', 'course_id'];

    /**
     * 
     */
    public function user(){
        return $this->belongsTo(User::class, 'action_user');
    }


    /**
     * 
     */
    public function course(){
        return $this->belongsTo(Course::class);
    }

    
    /**
     * 
     */
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
