<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseUnit;
use App\Models\User;
use App\Models\Step;

class CourseUnitFiles extends Model
{
    use HasFactory;

    protected $fillable = ['action_user', 'unit_id', 'step_id', 'file_name', 'file_path', 'file_ext', 'file_meta_data', 'is_approved', 'approved_by'];


    /**
     * Format Datetime
     */
    public function getCreatedAtAttribute($value){
        return date("M d, Y", strtotime($value));
    }



    /**
     * 
     */
    public function step(){
        return $this->belongsTo(Step::class);
    }


    /**
     * 
     */
    public function approvedby(){
        return $this->belongsTo(User::class, 'approved_by');
    }


    /**
     * 
     */
    public function unit(){
        return $this->belongsTo(CourseUnit::class, 'unit_id');
    }
}
