<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Assesment;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['action_user', 'user_id', 'first_name', 'last_name', 'phone', 'mobile', 'address_one', 'address_two', 'is_enrolled'];

    /**
     * Student's user account informations
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Action user's information
     */
    public function actionuser()
    {
        return $this->belongsTo(User::class, 'action_user');
    }


    /**
     * Enrollment
     */
    public function enrollment()
    {
        return $this->hasOne(Enrollment::class);
    }


    /**
     * 
     */
    public function assesments()
    {
        return $this->hasMany(Assesment::class);
    }
}
