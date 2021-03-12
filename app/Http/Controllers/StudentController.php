<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Builder\Class_;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Student::all());
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
            'lastname'     => 'required|string',
            'firstname'    => 'required|string',
            'age'          => 'required|integer',
            'year_start'   => 'required|integer',
            'classroom_id' => 'required|integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        $classroom = Classroom::find($request->classroom_id);

        if(!$classroom){
            return response()->json('La classe n\'existe pas' , 404);
        }
        return response()->json(Student::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::where('id', $id)->with('classroom')->first();

        if(!$student){
            return response()->json('élève pas trouvé', 404);
        }

        return response()->json($student);
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
        $student = Student::find($id);
        if(!$student){
            return response()->json('L\'élève n\'existe pas' , 404);
        }

        $validator = Validator::make($request->all(), [
            'lastname' => 'string',
            'firstname' => 'string',
            'age' => 'integer',
            'year_start' => 'integer',
            'classroom_id' => 'integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        return response()->json($student->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if(!$student){
            return response()->json('L\'élève n\'existe pas' , 404);
        }

        return response()->json($student->delete());
    }
}
