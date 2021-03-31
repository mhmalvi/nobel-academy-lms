<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\CoursesTeacher;
use Illuminate\Support\Str;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['action_user', 'user_id', 'first_name', 'last_name', 'phone', 'mobile', 'address_one', 'address_two'];


    /**
     * Set first name upper case first
     */
    public function setFirstNameAttribute($value){
        $this->attributes['first_name'] = Str::ucfirst($value);
    }


    /**
     * Set last name upper case first
     */
    public function setLastNameAttribute($value){
        $this->attributes['last_name'] = Str::ucfirst($value);
    }


    /**
     * Teacher's user account informations
     */
    public function user(){
        return $this->belongsTo(User::class);
    }



    /**
     * Action user's information
     */
    public function actionuser(){
        return $this->belongsTo(User::class, 'action_user');
    }



    /**
     * Enrollment
     */
    public function enrollments(){
        return $this->hasMany(Enrollment::class);
    }


    /**
     * Assigned Courses
     */
    public function courses(){
        return $this->hasMany(CoursesTeacher::class);
    }
}
