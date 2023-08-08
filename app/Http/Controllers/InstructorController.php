<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class InstructorController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $instructors= DB::table('instructors as i')
        ->select('i.id','e.first_name as employee','d.name as department')
        ->leftJoin('employees as e', 'e.id', '=', 'i.employee')
        ->leftJoin('departments as d', 'd.id', '=', 'i.department');

        $filterParameters = [
            'employee' => 'i.employee', 
            'department' => 'i.department', 
        ];

        foreach ($filterParameters as $parameter => $column) {
            $value = $request->input($parameter);
            if (isset($value) && $value !== '') {
                $companies->where($column, '=', $value);
            }
        }
           $search = $request->search;
           if (!is_null($search)){
               $instructors = $instructors
               ->where('i.id','LIKE','%'.$search.'%')
               ->orWhere('i.employee','LIKE','%'.$search.'%')
               ->orWhere('i.department','LIKE','%'.$search.'%');
           }
           $instructors = $instructors->orderBy('i.created_at','desc')->get();

           return response()->json([
               "message" => "instructor Data",
               "data" => $instructors,
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
            'employee'=>'required',
            'department'=>'required',
        
        ]);

        $instructor = new Instructor();
        $instructor->employee = $request->employee;
        $instructor->department = $request->department;
      
        $instructor->save();

        DB::commit();

        return response()->json([
            "msg" => "instructor Data",
            "data"=> $instructor,
        ],201);
    }catch(\Throwable $e) {
        DB::rollback();
        return response()->json([
            "msg"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
    }

    public function getOne( $id)
    {
        try {
            $instructor = DB::table('instructors as i')
        ->select('i.id','e.first_name as employee','d.id as department')
        ->leftJoin('employees as e', 'e.id', '=', 'i.employee')
        ->leftJoin('departments as d', 'd.id', '=', 'i.department')
        ->where('i.id',$id)
        ->first();

           return response()->json([
               "message" => "instructor Data",
               "data" => $instructor,
           ],200);
       }catch(\Throwable $e){
           return response()->json([
               "message"=>"oops something went wrong",
               "error"=> $e->getMessage(),
           ],500);
       }
    }
    public function update(Request $request,  $id)
    {
        DB::beginTransaction();
        try{
        $request->validate([
            'employee'=>'required',
            'department'=>'required',
        
        ]);

        $instructor = Instructor::find($id);
        $instructor->employee = $request->employee;
        $instructor->department = $request->department;
        $instructor->save();

        DB::commit();

        return response()->json([
            "msg" => "instructor Data",
            "data"=> $instructor,
        ],201);
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
        try{
            $instructor = Instructor::find($id);
            $instructor ->delete();
            return response()->json([
                "message" => "Instructor record deleted successfully",
            ], 200);
        }
        catch(\Throwable $e){
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
    }
}
