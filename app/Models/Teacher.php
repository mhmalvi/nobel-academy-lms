<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\CoursesTeacher;
use App\Support\AppCryption;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['action_user', 'user_id', 'first_name', 'last_name', 'phone', 'mobile', 'address_one', 'address_two'];


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
