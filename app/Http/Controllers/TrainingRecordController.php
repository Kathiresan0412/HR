<?php

namespace App\Http\Controllers;

use App\Models\TrainingRecord;
use Illuminate\Http\Request;
use DB;

class TrainingRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $training = DB::table('training_records as t')
            ->select('t.id','p.name as training_program','e.first_name as employee ','t.score','t.certificate')
            ->leftJoin('training_programs as p', 't.training_program', '=', 'p.id')
            ->leftJoin('employees as e', 't.employee', '=', 'e.id');


       
            $search = $request->search;

            if (!is_null($search)){
                $training = $training
                ->where('t.training_program','LIKE','%'.$search.'%')
                ->orWhere('t.employee','LIKE','%'.$search.'%')
                ->orWhere('t.score','LIKE','%'.$search.'%')
                ->orWhere('t.certificate','LIKE','%'.$search.'%');

            }
            $training = $training->orderBy('t.id','desc')->get();

            return response()->json([
                "message" => "training records Data",
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

        $training = new TrainingRecord();
        $training->training_program = $request->training_program;
        $training->employee = $request->employee;
        $training->score = $request->score;
        $training->certificate = $request->certificate;
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
    public function show(TrainingRecord $trainingRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingRecord $trainingRecord)
    {
        try{

            $training = DB::table('training_records as t')
            ->select('t.id','p.name as training_program','e.first_name as employee ','t.score','t.certificate')
            ->leftJoin('training_programs as p', 't.training_program', '=', 'p.id')
            ->leftJoin('employees as e', 't.employee', '=', 'e.id')
            ->where('t.id',$id)
            ->first();

            return response()->json([
                "message" => "training  record Data",
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

        $training = TrainingRecord::find($id);
        $training->training_program = $request->training_program;
        $training->employee = $request->employee;
        $training->score = $request->score;
        $training->certificate = $request->certificate;
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
        $training = TrainingRecord::find($id);
        $training->delete();
    }
}

