<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
    public function create()
    {
        //
    }

    public function show(Attendance $attendance)
    {
        //
    }

    public function  index (Request $request){

        try {
            $attendances = DB::table('attendances as at')
           ->select('at.id','at.date','e.first_name as employee','e.bio_code as bio_code','at.start_time','at.end_time','at.worked_hrs','at.work_shift_tot_hrs','at.status')
           ->leftJoin('employees as e', 'e.id', '=', 'at.employee');

           $search = $request->search;
           if (!is_null($search)){
               $attendances = $attendances
               ->where('at.id','LIKE','%'.$search.'%')
               ->orWhere('at.date','LIKE','%'.$search.'%')
               ->orWhere('at.employee','LIKE','%'.$search.'%')
               ->orWhere('at.start_time','LIKE','%'.$search.'%')
               ->orWhere('at.end_time','LIKE','%'.$search.'%')
               ->orWhere('at.worked_hrs','LIKE','%'.$search.'%')
               ->orWhere('at.work_shift_tot_hrs','LIKE','%'.$search.'%')
               ->orWhere('at.status','LIKE','%'.$search.'%');


           }
           $attendances = $attendances->orderBy('at.id','desc')->get();

           return response()->json([
               "message" => "attendances Data",
               "data" => $attendances,
           ],200);
       }catch(\Throwable $e){
           return response()->json([
               "message"=>"oops something went wrong",
               "error"=> $e->getMessage(),
           ],500);
       }
      }

      public function  edit($id){
       // return 's';
        try {
            $attendances = DB::table('attendances as at')
            ->select('at.id','at.date','e.first_name as employee','e.bio_code as bio_code','at.start_time','at.end_time','at.worked_hrs','at.work_shift_tot_hrs','at.status')
            ->leftJoin('employees as e', 'e.id', '=', 'at.employee')
           ->where('at.id',$id)
           ->first();



           return response()->json([
               "message" => "attendances Data",
               "data" => $attendances,
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
            'employee'=>'required',
             'date'=>'required',
             'start_time'=>'required',
             'end_time'=>'required',
             'worked_hrs'=>'required',
             'work_shift_tot_hrs'=>'required',
             'status'=>'required'
         ]);

         $attendances = new Attendance();
         $attendances->employee = $request->employee;
         $attendances->date = $request->date;
         $attendances->start_time = $request->start_time;
         $attendances->end_time = $request->end_time;
         $attendances->worked_hrs = $request->worked_hrs;
         $attendances->work_shift_tot_hrs = $request->work_shift_tot_hrs;
         $attendances->status = $request->status;

         $attendances->save();

         DB::commit();

         return response()->json([
             "msg" => " save attendances Data",
             "data"=> $attendances,
         ],201);
     }catch(\Throwable $e) {
         DB::rollback();
         return response()->json([
             "msg"=>"oops something went wrong",
             "error"=> $e->getMessage(),
         ],500);
     }
 }

 public function update(Request $request, $id)
 {
     DB::beginTransaction();
     try{
         $request->validate([
             'employee'=>'required',
             'date'=>'required',
             'start_time'=>'required',
             'end_time'=>'required',
             'worked_hrs'=>'required',
             'work_shift_tot_hrs'=>'required',
             'status'=>'required'
         ]);

         $attendances =  Attendance::find($id);
         $attendances->employee = $request->employee;
         $attendances->date = $request->date;
         $attendances->start_time = $request->start_time;
         $attendances->end_time = $request->end_time;
         $attendances->worked_hrs = $request->worked_hrs;
         $attendances->work_shift_tot_hrs = $request->work_shift_tot_hrs;
         $attendances->status = $request->status;
         $attendances->save();

         DB::commit();

         return response()->json([
             "msg" => " update attendances Data",
             "data"=> $attendances,
         ],201);
     }catch(\Throwable $e) {
         DB::rollback();
         return response()->json([
             "msg"=>"oops something went wrong",
             "error"=> $e->getMessage(),
         ],500);
     }
 }

 public function destroy($id)
{
    try {
        $attendances = Attendance::find($id);
        $attendances->delete();

    } catch (\Throwable $e) {
        return response()->json([
            "message" => "Ooops Something went wrong please try again",
            "error" => $e->getMessage(),
        ], 500);
    }
    }
      
  
}
