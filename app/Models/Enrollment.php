<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\User;
use App\Support\AppCryption;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'action_user',
        'student_id',
        'teacher_id',
        'course_id',
        'core_module_num',
        'elective_module_num',
        'core_pass',
        'elective_pass',
        'progress',
        'is_passed',
        'is_suspended',
        'status',
        'remark'
    ];


    protected $casts = [
        'core_units' => 'array',
        'elective_units' => 'array',
    ];


    /**
     * Action User
     */
    public function user(){
        return $this->belongsTo(User::class, 'action_user');
    }


    /**
     * 
     */
    public function student(){
        return $this->belongsTo(Student::class);
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
