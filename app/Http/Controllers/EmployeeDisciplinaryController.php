<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDisciplinary;
use Illuminate\Http\Request;
use DB;


class EmployeeDisciplinaryController extends Controller
{
    
    public function index(Request $request)
    {
        try{
            $empDiscipline = DB::table('employee_disciplinaries as e')
            ->select('e.id','em.id as employee','e.incident_date', 'e.description','e.follow_up_notes')
            ->leftJoin('employees as em', 'em.id', '=', 'e.employee');
       
            $search = $request->search;
            if (!is_null($search)){
                $empDiscipline = $empDiscipline
                ->where('e.incident_date','LIKE','%'.$search.'%')
                ->orWhere('e.description','LIKE','%'.$search.'%')
                ->orWhere('e.follow_up_notes','LIKE','%'.$search.'%');
            }
            $empDiscipline = $empDiscipline->orderBy('e.id','desc')->get();
  
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
    


    public function edit($id)
    {
        try{

            $empDiscipline = DB::table('employee_disciplinaries as e')
            ->select('e.id','em.id as employee','e.incident_date', 'e.description','e.follow_up_notes')
            ->leftJoin('employees as em', 'em.id', '=', 'e.employee')
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
    
    
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'incident_date'=>'required',
                'description'=>'required',
                'follow_up_notes'=>'required'
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

    public function update(EmployeeDisciplinary $employeeDisciplinary, Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'incident_date'=>'required',
                'description'=>'required',
                'follow_up_notes'=>'required'
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
    
    
    public function delete($id)
    {
        $empDiscipline = EmployeeDisciplinary::find($id);
        $empDiscipline->delete();
    }

    
}
