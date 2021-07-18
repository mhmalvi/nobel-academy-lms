<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activation extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['id'];
    protected $fillable = ['action_user', 'type', 'status'];
}
