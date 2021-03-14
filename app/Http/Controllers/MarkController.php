<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Mark::all());
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
            'mark'        => 'required|integer',
            'student_id'  => 'required|integer',
            'course_id'   => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
            $mark = $request->mark;
            if($mark > 20){
                return response()->json('note dépasse 20', 404);
            }

            $student = Student::find($request->student_id);
            if(!$student){
                return response()->json('L\'élève existe pas' , 404);
            }

            $course = Course::find($request->course_id);
            if(!$course){
                return response()->json('Le cours existe pas' , 404);
            }
            return response()->json(Mark::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mark = Mark::where('id', $id)->with('student' , 'course')->first();

        if(!$mark){
            return response()->json('note pas trouvé', 404);
        }

        return response()->json($mark);
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
        $mark = Mark::find($id);
        if(!$mark){
            return response()->json('Le cours n\'existe pas' , 404);
        }

        $validator = Validator::make($request->all(), [
            'mark'        => 'integer',
            'student_id'  => 'integer',
            'course_id'   => 'integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        $mark = $request->mark;
        if($mark > 20){
            return response()->json('note dépasse 20', 404);
        }

        return response()->json($mark->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
