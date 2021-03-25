<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseUnit;
use App\Models\User;
use App\Support\AppCryption;

class CourseUnitFiles extends Model
{
    use HasFactory;

    protected $fillable = ['action_user', 'unit_id', 'file_name', 'file_path', 'file_ext', 'file_meta_data', 'is_approved', 'approved_by'];


    /**
     * 
     */
    public function actionuser(){
        return $this->belongsTo(User::class, 'action_user');
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
        return $this->belongsTo(CourseUnit::class);
    }
}
