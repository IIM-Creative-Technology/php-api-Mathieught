<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Professor::all());
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
            'year_start'   => 'required|integer',
        ]);

        if($validator->fails()){
        return response()->json($validator->errors(), 400);
        }
        $lastname = $request->lastname;
        $firstname= $request->firstname;

        $professor = Professor::where(['lastname' => $lastname] , ['firstname', $firstname])->first();

        if($professor){
            return response()->json('l\'intervenant existe deja' , 409);
        }
        return response()->json(Professor::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professor = Professor::find($id);

        if(!$professor){
            return response()->json('Professeur pas trouvé', 404);
        }

        return response()->json($professor);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professor = Professor::find($id);
        if(!$professor){
            return response()->json('Professeur pas trouvé' , 404);
        }

        return response()->json($professor->delete());
    }
}
