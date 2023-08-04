<?php

namespace App\Http\Controllers;
use App\Models\WorkShiftDetail;
use App\Models\EmployeeWorkShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EmployeeWorkShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $EmployeeWorkShift = DB::table('employee_work_shifts as ews')
           ->select('ews.id','e.first_name as employee','ews.title','ews.date','ews.is_of_hour','ews.is_of_day')
          // ->leftJoin('employee_work_shifts as ews','ews.id','=','wsd.work_shif_id')
           ->leftJoin('employees as e', 'e.id', '=', 'ews.employee');

           $EmployeeWorkShift = $EmployeeWorkShift->orderBy('ews.id','desc')->get();
           return response()->json([
               "message" => "work shift Data",
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
        try{
            $request->validate([
                'title'=>'required',
                'employee'=>'required',
                'date'=>'required',
                //'count'=>'required',
            ]);
            $EmployeeWorkShift = new EmployeeWorkShift();
            $EmployeeWorkShift->title = $request->title;
            $EmployeeWorkShift->employee = $request->employee;
            $EmployeeWorkShift->date = $request->date;
            $EmployeeWorkShift->is_of_day = $request->is_of_day;
            $EmployeeWorkShift->is_of_hour = $request->is_of_hour;
           // $allowedleaves->count = $request->count;
            $EmployeeWorkShift->save();
            $workshift=$EmployeeWorkShift->id;

            $WorkShiftDetail = $request->WorkShiftDetails;
            foreach($WorkShiftDetail as $WorkShiftDetail){
            $WorkShiftDetail = new WorkShiftDetail();
            $WorkShiftDetail->work_shif_id = $request->$workshift;
            $WorkShiftDetail->from = $request->from;
            $WorkShiftDetail->to = $request->to;
            $WorkShiftDetail->save();
              }
           
            DB::commit();

            return response()->json([
                "msg" => "allowedleaves Data",
                "data"=> $EmployeeWorkShift,
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
    public function show(EmployeeWorkShift $employeeWorkShift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        try {
            $EmployeeWorkShift = DB::table('employee_work_shifts as ews')
           ->select('ews.id','e.first_name as employee','ews.title','ews.date','ews.is_of_hour','ews.is_of_day')
          // ->leftJoin('employee_work_shifts as ews','ews.id','=','wsd.work_shif_id')
           ->leftJoin('employees as e', 'e.id', '=', 'ews.employee');
           $EmployeeWorkShift = $EmployeeWorkShift->orderBy('ews.id','desc')->get()
           ->where('ews.id',$id)
           ->first();
           return response()->json([
               "message" => "work shift Data",
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
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        try{
            $request->validate([
                'title'=>'required',
                'employee'=>'required',
                'date'=>'required',
                //'count'=>'required',
            ]);
            $EmployeeWorkShift =  EmployeeWorkShift::find($id);
            $EmployeeWorkShift->title = $request->title;
            $EmployeeWorkShift->employee = $request->employee;
            $EmployeeWorkShift->date = $request->date;
            $EmployeeWorkShift->is_of_day = $request->is_of_day;
            $EmployeeWorkShift->is_of_hour = $request->is_of_hour;
           // $allowedleaves->count = $request->count;
            $EmployeeWorkShift->save();
           // $workshift=$EmployeeWorkShift->id;

           WorkShiftDetail::where('work_shift_detail',$id)->delete();
            $WorkShiftDetail = $request->WorkShiftDetails;
            if(!is_null($qualification)){
            foreach($WorkShiftDetail as $WorkShiftDetail){
            $WorkShiftDetail = new WorkShiftDetail();
            $WorkShiftDetail->work_shif_id = $request->$id;
            $WorkShiftDetail->from = $request->from;
            $WorkShiftDetail->to = $request->to;
            $WorkShiftDetail->save();
            }
              }
           
            DB::commit();

            return response()->json([
                "msg" => "allowedleaves Data",
                "data"=> $EmployeeWorkShift,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
      
    
    public function destroy( $id)
    {
        try{
            $WorkShiftDetail = WorkShiftDetail::find($id);
            $WorkShiftDetail ->delete();
        }
        catch(\Throwable $e){
        return response()->json([
            "message"=>"Ooops Something went wrong please try again",
            "error"=> $e->getMessage(),
        ],500);
    }
    }
}
