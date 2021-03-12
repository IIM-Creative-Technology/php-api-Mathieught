<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year_end',
    ];

    // link classroom to student
    public function students(){
        return $this->hasMany(Student::class);
    }
}
