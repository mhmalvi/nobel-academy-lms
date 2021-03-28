<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitProgress extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'uuid', 
        'action_user', 
        'student_id', 
        'course_id', 
        'course_unit_id',
        'steps', 
    ];

    protected $cast = [
        'steps' => 'array'
    ];

    /**
     * 
     */
    public function courseUnit(){
        return $this->belongsTo(CourseUnit::class);
    }
}
