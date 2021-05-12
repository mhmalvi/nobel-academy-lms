<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Student;
use App\Models\Course;
use App\Models\CourseUnit;

class Assesment extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'student_id', 'course_id', 'unit_id', 'links', 'status'];


    /**
     * 
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    /**
     * 
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    /**
     * 
     */
    public function unit()
    {
        return $this->belongsTo(CourseUnit::class);
    }
}
