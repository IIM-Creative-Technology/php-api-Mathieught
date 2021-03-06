<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'lastname',
        'firstname',
        'age',
        'year_start',
        'classroom_id',
    ];

    // link student to classroom
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}
