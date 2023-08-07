<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDisciplinary;
use Illuminate\Http\Request;
use DB;


class EmployeeDisciplinaryController extends Controller
{
    
    public function getAllEmployeeDisciplinary(Request $request)
    {
        try{
            $empDiscipline = DB::table('employee_disciplinaries as e')
            ->select('e.id','e.id as employee','e.incident_date', 'e.description','e.follow_up_notes')
            ->leftJoin('employees as e', 'e.id', '=', 'e.employee');
       
            $search = $request->search;
            if (!is_null($search)){
                $empDiscipline = $empDiscipline
                ->where('e.incident_date','LIKE','%'.$search.'%')
                ->orWhere('e.description','LIKE','%'.$search.'%')
                ->orWhere('e.follow-up-notes','LIKE','%'.$search.'%');
            }
            $empDiscipline = $empDiscipline->orderBy('c.id','desc')->get();
  
            return response()->json([
                "message" => "Employee Disciplinary Data",
                "data" => $empDiscipline,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
    


    public function getEmployeeDisciplinaryInfo($id)
    {
        try{

            $empDiscipline = DB::table('employee_disciplinaries as e')
            ->select('e.id','e.id as employee','e.incident_date', 'e.description','e.follow_up_notes')
            ->leftJoin('employees as e', 'e.id', '=', 'e.employee')
            ->where('e.id',$id)
            ->first();

            return response()->json([
                "message" => "Employee Disciplinary Data",
                "data" => $empDiscipline,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
    
    
    public function storeEmployeeDisciplinary(Request $request)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'incident_date'=>'required',
                'description'=>'required',
                'follow-up-notes'=>'required'
            ]);
    
            $empDiscipline = new EmployeeDisciplinary();
            $empDiscipline->employee = $request->employee;
            $empDiscipline->incident_date = $request->incident_date;
            $empDiscipline->description = $request->description;
            $empDiscipline->follow_up_notes = $request->follow_up_notes;
            $empDiscipline->save();
    
            DB::commit();
    
            return response()->json([
                "message" => "Employee Disciplinary Data",
                "data" => $empDiscipline,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    public function updateEmployeeDisciplinary(EmployeeDisciplinary $employeeDisciplinary, Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'incident_date'=>'required',
                'description'=>'required',
                'follow-up-notes'=>'required'
            ]);
    
            $empDiscipline = EmployeeDisciplinary::find($id);
            $empDiscipline->employee = $request->employee;
            $empDiscipline->incident_date = $request->incident_date;
            $empDiscipline->description = $request->description;
            $empDiscipline->follow_up_notes = $request->follow_up_notes;
            $empDiscipline->save();
        
            DB::commit();
        
            return response()->json([
                "message" => "Employee Disciplinary Data",
                "data" => $empDiscipline,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
    
    
    public function destroyEmployeeDisciplinary($id)
    {
        $empDiscipline = EmployeeDisciplinary::find($id);
        $empDiscipline->delete();
    }

    
}
