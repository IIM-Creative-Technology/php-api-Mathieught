<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Classroom::all());
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
            'name' => 'required',
            'year_end' => 'integer|required',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        $name = $request->name;
        $year_end = $request->year_end;

        $classroom = Classroom::where(['name' => $name] , ['year_end', $year_end])->first();

        if($classroom){
            return response()->json('La classe existe déjà' , 409);
        }
        return response()->json(Classroom::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $classroom = Classroom::find($id);
        if(!$classroom){
            return response()->json('La classe n\'existe pas' , 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'year_end' => 'integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }

        return response()->json($classroom->update($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = Classroom::find($id);
        if(!$classroom){
            return response()->json('La classe n\'existe pas' , 404);
        }

        return response()->json($classroom->delete());
    }
}
