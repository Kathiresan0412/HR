<?php

namespace App\Http\Controllers;

use App\Models\WorkShiftDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkShiftDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $EmployeeWorkShift = DB::table('work_shift_details as wsd')
           ->select('wse.id','e.first_name as employee','ews.title as title','ews.date as date','ews.date as date','ews.is_of_hour as is_of_hour','ews.is_of_day as is_of_day','wsd.from','wsd.to')
           ->leftJoin('employee_work_shifts as ews','ews.id','=','wsd.work_shif_id')
           ->leftJoin('employees as e', 'e.id', '=', 'ews.employee');

           $EmployeeWorkShift = $EmployeeWorkShift->orderBy('l.id','desc')->get();
           return response()->json([
               "message" => "allowedleaves Data",
               "data" => $EmployeeWorkShift,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkShiftDetail $workShiftDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkShiftDetail $workShiftDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkShiftDetail $workShiftDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkShiftDetail $workShiftDetail)
    {
        //
    }
}
