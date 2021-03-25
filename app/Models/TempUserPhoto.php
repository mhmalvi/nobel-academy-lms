<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempUserPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'foldername'];
}
