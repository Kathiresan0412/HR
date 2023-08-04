<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $instructor = DB::table('instructors as i')
        ->select('i.id','e.first_name as employee','d.id as department')
        ->leftJoin('employees as e', 'e.id', '=', 'i.employee')
        ->leftJoin('departments as d', 'd.id', '=', 'i.department');

           $search = $request->search;
           if (!is_null($search)){
               $instructor = $instructor
               ->where('i.id','LIKE','%'.$search.'%')
               ->orWhere('i.employee','LIKE','%'.$search.'%')
               ->orWhere('i.department','LIKE','%'.$search.'%');
           }
           $instructor = $instructor->orderBy('i.id','desc')->get();

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

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
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

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try{
            $instructor = Instructor::find($id);
            $instructor ->delete();

        }
        catch(\Throwable $e){
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
    }
}
