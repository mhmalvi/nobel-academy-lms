<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitProgress extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $cast = [
        'steps' => 'array'
    ];

    /**
     * 
     */
    public function user()
    {
        $this->belongsTo(User::class, 'student_id');
    }

    /**
     * 
     */
    public function courseUnit()
    {
        return $this->belongsTo(CourseUnit::class);
    }
}
