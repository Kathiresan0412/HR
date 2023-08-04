<?php

namespace App\Http\Controllers;

use App\Models\TrainingProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainingProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $training = DB::table('training_programs as t')
            ->select('t.id','t.name','t.description','t.start_date','t.end_date','i.id as instructor','t.location')
            ->leftJoin('instructors as i', 't.instructor', '=', 'i.id');

       
            $search = $request->search;
            if (!is_null($search)){
                $training = $training
                ->where('t.name','LIKE','%'.$search.'%')
                ->orWhere('t.description','LIKE','%'.$search.'%')
                ->orWhere('t.start_date','LIKE','%'.$search.'%')
                ->orWhere('t.end_date','LIKE','%'.$search.'%')
                ->orWhere('t.instructor','LIKE','%'.$search.'%')
                ->orWhere('t.location','LIKE','%'.$search.'%');

            }
            $training = $training->orderBy('t.id','desc')->get();

            return response()->json([
                "message" => "training Data",
                "data" => $training,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{

        $training = new TrainingProgram();
        $training->name = $request->name;
        $training->description = $request->description;
        $training->start_date = $request->start_date;
        $training->end_date = $request->end_date;
        $training->instructor = $request->instructor;
        $training->location = $request->location;
        $training->save();

        DB::commit();

        return response()->json([
            "msg" => "training Data",
            "data"=> $training,
        ],201);
    }catch(\Throwable $e) {
        DB::rollback();
        return response()->json([
            "msg"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingProgram $trainingProgram)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{

            $training = DB::table('training_programs as t')
            ->select('t.id','t.name','t.description','t.start_date','t.end_date','i.id as instructor','t.location')
            ->leftJoin('instructors as i', 't.instructor', '=', 'i.id')
            ->where('t.id',$id)
            ->first();

            return response()->json([
                "message" => "training Data",
                "data" => $training,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{

        $training = TrainingProgram::find($id);
        $training->name = $request->name;
        $training->description = $request->description;
        $training->start_date = $request->start_date;
        $training->end_date = $request->end_date;
        $training->instructor = $request->instructor;
        $training->location = $request->location;
        $training->save();  
     
      DB::commit();

      return response()->json([
        "msg" => "training Data",
        "data"=> $training,
    ],201);
}catch(\Throwable $e) {
    DB::rollback();
    return response()->json([
        "msg"=>"oops something went wrong",
        "error"=> $e->getMessage(),
    ],500);
}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $trainingProgram = TrainingProgram::find($id);
        $trainingProgram->delete();
    }
}