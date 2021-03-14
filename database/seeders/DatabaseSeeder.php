<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Mark;
use App\Models\Professor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('classrooms')->truncate();
    DB::table('students')->truncate();
    DB::table('professors')->truncate();
    DB::table('courses')->truncate();
    DB::table('marks')->truncate();
    DB::table('users')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');


    Classroom::factory(4)->create();
    Student::factory(10)->create();
    Professor::factory(4)->create();
    Course::factory(6)->create();
    Mark::factory(25)->create();

    User::factory(3)->state(new Sequence(
        [
            'name' => 'Nicolas',
            'email' => 'nicolas@gmail.com',
        ],
        [
            'name' => 'Alexis',
            'email' => 'alexis@gmail.com',
        ],
        [
            'name' => 'Karine',
            'email' => 'karine@gmail.com',
        ],
    ))->create();
    }
}
