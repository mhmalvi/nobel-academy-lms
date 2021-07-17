<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'user_type',
        'isBanned',
        'role_id',
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
     * Set Password Hasable
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
     * Teacher
     */
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }


    /**
     * Student
     */
    public function student()
    {
        return $this->hasOne(Student::class);
    }


    /**
     * Enrollments
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'action_user');
    }

    /**
     * Check for admin
     */
    public function isAdmin()
    {
        return in_array($this->email, config('learnque.admins'));
    }
}
