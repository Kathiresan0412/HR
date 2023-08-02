<?php

namespace App\Http\Controllers;

use App\Models\EmployeeQualifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeQualificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeQualifications $employeeQualifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeQualifications $employeeQualifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeQualifications $employeeQualifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeQualifications $employeeQualifications)
    {
        //
    }
    public function getAllEmployeeQualifications(Request $request,)
  {
   
      try{
          $EmployeeQualifications = DB::table('employee_qualifications as eq')
          ->select('eq.id','emp.first_name as employee ','qu.name as qualification')
          ->leftJoin('employees as emp','emp.id','=','eq.employee')
          ->leftJoin('qualifications as qu','qu.id','=','eq.qualification');
     
          $search = $request->search;
          if (!is_null($search)){
              $EmployeeQualifications = $EmployeeQualifications
              ->where('eq.qualification','LIKE','%'.$search.'%')
              ->orWhere('eq.employee','LIKE','%'.$search.'%');
          }
          $EmployeeQualifications = $EmployeeQualifications->orderBy('eq.id','desc')->get();

          return response()->json([
              "message" => "company Data",
              "data" => $EmployeeQualifications,
          ],200);
      }catch(\Throwable $e){
          return response()->json([
              "message"=>"oops something went wrong",
              "error"=> $e->getMessage(),
          ],500);
      }
  }

  public function getEmployeeQualifications($id)
  {
      try{

        $EmployeeQualifications = DB::table('employee_qualifications as eq')
        ->select('eq.id','emp.first_name as employee ','qu.name as qualification')
        ->leftJoin('employees as emp','emp.id','=','eq.employee')
        ->leftJoin('qualifications as qu','qu.id','=','eq.qualification')
          ->where('eq.id',$id)
          ->first();

          return response()->json([
              "message" => "company Data",
              "data" => $EmployeeQualifications
          ],200);
      }catch(\Throwable $e){
          return response()->json([
              "message"=>"oops something went wrong",
              "error"=> $e->getMessage(),
          ],500);
      }
  }
}
