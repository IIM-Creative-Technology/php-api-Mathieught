<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'mark',
        'student_id',
        'course_id',
    ];

    // link  mark to course
    public function course(){
        return $this->belongsTo(Course::class);
    }
    // link  mark to student
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
