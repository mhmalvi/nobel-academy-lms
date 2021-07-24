<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Full Name
     */
    public function getUserFullName()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    /**
     * User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
