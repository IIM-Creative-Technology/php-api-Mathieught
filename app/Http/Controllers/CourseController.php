<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Professor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Course::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string',
            'date_start'    => 'required|date',
            'date_end'          => 'required|date',
            'professor_id'   => 'required|integer',
            'classroom_id' => 'required|integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        $professor = Professor::find($request->professor_id);
        if(!$professor){
            return response()->json('Le professeur n\'existe pas' , 404);
        }

        $classroom = Classroom::find($request->classroom_id);
        if(!$classroom){
            return response()->json('La classe n\'existe pas' , 404);
        }
        $date_start = Carbon::parse($request->date_start);
        $date_end = Carbon::parse($request->date_end);
        if($date_start->diffInDays($date_end) > 5){
            return response()->json('Date dépasse les 5 jours', 404);
        }
        return response()->json(Course::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::where('id', $id)->with('classroom' , 'professor')->first();

        if(!$course){
            return response()->json('cours pas trouvé', 404);
        }

        return response()->json($course);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if(!$course){
            return response()->json('Le cours n\'existe pas' , 404);
        }

        $validator = Validator::make($request->all(), [
            'name'     => 'string',
            'date_start'    => 'date',
            'date_end'          => 'date',
            'professor_id'   => 'integer',
            'classroom_id' => 'integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        $date_start = Carbon::parse($request->date_start);
        $date_end = Carbon::parse($request->date_end);
        if($date_start->diffInDays($date_end) > 5){
            return response()->json('Date dépasse les 5 jours', 404);
        }

        return response()->json($course->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if(!$course){
            return response()->json('Le cours n\'existe pas' , 404);
        }

        return response()->json($course->delete());
    }
}
