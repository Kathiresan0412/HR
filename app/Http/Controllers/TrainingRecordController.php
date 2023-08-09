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
    public function getAll(Request $request)
    {
        try{
            $trainingrecords = DB::table('training_records as t')
            ->select('t.id','p.name as training_program','e.first_name as employee ','t.score','t.certificate')
            ->leftJoin('training_programs as p', 't.training_program', '=', 'p.id')
            ->leftJoin('employees as e', 't.employee', '=', 'e.id');

            $search = $request->search;

            if (!is_null($search)){
                $trainingrecords = $trainingrecords
                ->where('t.training_program','LIKE','%'.$search.'%')
                ->orWhere('t.employee','LIKE','%'.$search.'%')
                ->orWhere('t.score','LIKE','%'.$search.'%')
                ->orWhere('t.certificate','LIKE','%'.$search.'%');
            }
            $filterParameters = [
                'training_program' => 't.training_program',
                'employee' => 't.employee',
                'score' => 't.score',                     
            ];
        
            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $trainingrecords->where($column, '=', $value);
                }
            }
            $training = $trainingrecords->orderBy('t.created_at','desc')->get();

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

    public function save(Request $request)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'training_program'=>'required',
                'employee'=>'required',
                'score'=>'required',
                'certificate'=>'required'
            ]);

        $trainingrecord = new TrainingRecord();
        $trainingrecord->training_program = $request->training_program;
        $trainingrecord->employee = $request->employee;
        $trainingrecord->score = $request->score;
        $trainingrecord->certificate = $request->certificate;
        $trainingrecord->save();

        DB::commit();

        return response()->json([
            "message" => "training record Data Saved",
            "data"=> $trainingrecord,
        ],200);
    }catch(\Throwable $e) {
        DB::rollback();
        return response()->json([
            "message"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
    }

    public function getOne(TrainingRecord $trainingRecord, $id)
    {
        try{
            $trainingrecord = DB::table('training_records as t')
            ->select('t.id','p.name as training_program','e.first_name as employee ','t.score','t.certificate')
            ->leftJoin('training_programs as p', 't.training_program', '=', 'p.id')
            ->leftJoin('employees as e', 't.employee', '=', 'e.id')
            ->where('t.id',$id)
            ->first();

            return response()->json([
                "message" => "training record Data",
                "data" => $trainingrecord
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'training_program'=>'required',
                'employee'=>'required',
                'score'=>'required',
                'certificate'=>'required'
            ]);

        $trainingrecord = TrainingRecord::find($id);
        $trainingrecord->training_program = $request->training_program;
        $trainingrecord->employee = $request->employee;
        $trainingrecord->score = $request->score;
        $trainingrecord->certificate = $request->certificate;
        $trainingrecord->save();  
     
        DB::commit();

      return response()->json([
        "message" => "training record Data Updated",
        "data"=> $trainingrecord,
    ],200);
    }catch(\Throwable $e) {
    DB::rollback();
    return response()->json([
        "message"=>"oops something went wrong",
        "error"=> $e->getMessage(),
    ],500);
}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try {
            $trainingrecord = TrainingRecord::find($id);
            $trainingrecord->delete();

            return response()->json([
                "message" => "Training Record Data Deleted",
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}

