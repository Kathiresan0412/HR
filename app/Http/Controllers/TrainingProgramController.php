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
    public function getAll(Request $request)
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
            $filterParameters = [
                'name' => 't.name',
                'start_date' => 't.start_date',
                'description' => 't.description',  
                'end_date' => 't.end_date',           
                'instructor' => 't.instructor',           
                'location' => 't.location',           
            ];
        
            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $training->where($column, '=', $value);
                }
            }
            $training = $training->orderBy('t.created_at','desc')->get();

            return response()->json([
                "message" => "All training program Data",
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
                'name'=>'required',
                'description'=>'required',
                'start_date'=>'required',
                'end_date'=>'required',
                'instructor'=>'required',
                'location'=>'required'
            ]);

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
            "msg" => "Training program Data Saved",
            "data"=> $training,
        ],200);
    }catch(\Throwable $e) {
        DB::rollback();
        return response()->json([
            "msg"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
    }

    public function getOne($id)
    {
        try{
            $training = DB::table('training_programs as t')
            ->select('t.id','t.name','t.description','t.start_date','t.end_date','i.id as instructor','t.location')
            ->leftJoin('instructors as i', 't.instructor', '=', 'i.id')
            ->where('t.id',$id)
            ->first();

            return response()->json([
                "message" => "training program Data",
                "data" => $training,
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
                'name'=>'required',
                'description'=>'required',
                'start_date'=>'required',
                'end_date'=>'required',
                'instructor'=>'required',
                'location'=>'required'
            ]);

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
        "msg" => "Training program Data updated",
        "data"=> $training,
    ],200);
}catch(\Throwable $e) {
    DB::rollback();
    return response()->json([
        "msg"=>"oops something went wrong",
        "error"=> $e->getMessage(),
    ],500);
}
    }

    public function delete($id)
    {
         try {
            $training = TrainingProgram::find($id);
            $training->delete();

            return response()->json([
                "msg" => "Training program Data Deleted",
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}