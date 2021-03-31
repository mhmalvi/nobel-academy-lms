<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseUnitFiles;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_name',
        'descriptions',
    ];


    /**
     * Attributr that should be casts
     */
    protected $casts = [
        'created_at' => 'datetime:d-M-Y',
    ];


    /**
     * 
     */
    public function getCreatedAtAttribute($value){
        return date("M d, Y", strtotime($value));
    }


    /**
     * 
     */
    public function setStepNameAttribute($value){
        $this->attributes['step_name'] = ucfirst($value);
    }


    /**
     *
     */
    public function files(){
        return $this->hasMany(CourseUnitFiles::class);
    }
}
