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
     *
     */
    public function files(){
        return $this->hasMany(CourseUnitFiles::class);
    }
}
