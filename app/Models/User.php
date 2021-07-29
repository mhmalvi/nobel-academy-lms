<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Support\AppCryption;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'photo',
        'user_type',
        'isBanned',
        'role_id',
        'classroom_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Encrypt uuid
     */
    public function setUuidAttribute($value)
    {
        $this->attributes['uuid'] = AppCryption::encrypt($value);
    }

    /**
     * Encrypt uuid
     */
    public function getUuidAttribute($value)
    {
        return AppCryption::decrypt($value);
    }


    /**
     * 
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }


    /**
     * Set Password Hasable
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    /**
     * 
     */
    public function getUserTypeAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Enrollments
     */
    public function enrollments()
    {
        return $this->hasOne(Enrollment::class, 'student_id');
    }

    /**
     * Check for admin
     */
    public function isAdmin()
    {
        return in_array($this->email, config('learnque.admins'));
    }

    /**
     * User Info
     */
    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }


    /**
     * 
     */
    public function progress()
    {
        return $this->hasOne(UnitProgress::class, 'student_id');
    }


    /**
     * 
     */
    public function teacher()
    {
        return $this->belongsToMany(Course::class, 'teachers', 'user_id', 'course_id');
    }

    /**
     * 
     */
    public function classroomOfStudent()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }


    public function classroomOfTeacher()
    {
        return $this->hasMany(Classroom::class, 'teacher_id');
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
