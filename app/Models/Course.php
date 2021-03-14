<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'professor_id',
        'classroom_id',
    ];

        // link  course to professor
        public function professor(){
            return $this->belongsTo(Professor::class);
        }
        // link  course to classroom
        public function classroom(){
            return $this->belongsTo(Classroom::class);
        }
}
