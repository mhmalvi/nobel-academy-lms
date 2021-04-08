<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Models\Course;

class CourseUnit extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['action_user', 'course_id', 'unit_type', 'unit_code', 'unit_name', 'descriptions', 'is_published'];


    /**
     * Format Datetime
     */
    public function getCreatedAtAttribute($value){
        return date("M d, Y", strtotime($value));
    }


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
    public function progress(){
        return $this->hasOne(UnitProgress::class);
    }


    /**
     * 
     */
    public function files(){
        return $this->hasMany(CourseUnitFiles::class, 'unit_id');
    }
}
