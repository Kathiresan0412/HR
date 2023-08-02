<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveTypeController extends Controller
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
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveType $leaveType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveType $leaveType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveType $leaveType)
    {
        //
    }
    public function getAllLeaveTypes(Request $request)
    {
        try {
            $leavetypes = DB::table('leave_types as t')
           ->select('t.id','t.name','t.is_no_pay','t.description');

           $search = $request->search;

           if (!is_null($search)){
               $leavetypes = $leavetypes
               ->where('t.id','LIKE','%'.$search.'%')
               ->orWhere('t.is_no_pay','LIKE','%'.$search.'%')
               ->orWhere('t.description','LIKE','%'.$search.'%');
             
           }
          

           $leavetypes = $leavetypes->orderBy('t.id','desc')->get();

           return response()->json([
               "message" => "leavetypes Data",
               "data" => $leavetypes,
           ],200);
       }catch(\Throwable $e){
           return response()->json([
               "message"=>"oops something went wrong",
               "error"=> $e->getMessage(),
           ],500);
       }
    }
    public function getLeaveTypesinfo($id)
    {
        try{

            $leavetypes = DB::table('leave_types as t')
           ->select('t.id','t.name','t.is_no_pay','t.description');

      
           $leavetypes = $leavetypes->orderBy('t.id','desc')
            ->where('t.id',$id)
            ->first();

            return response()->json([
                "message" => "leavetypes Data",
                "data" => $leavetypes,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    
    public function saveLeaveTypes(Request $request)
    {
        DB::beginTransaction();

        try{
            $request->validate([
                'name'=>'required',
                'is_no_pay'=>'required',
                'description'=>'required',
            ]);
    
            $leavetypes = new LeaveType();
            $leavetypes->name = $request->name;
            $leavetypes->is_no_pay = $request->is_no_pay;
            $leavetypes->description = $request->description;
            $leavetypes->save();
    
            DB::commit();
    
            return response()->json([
                "msg" => "leavetypes Data",
                "data"=> $leavetypes,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

   
    public function updateLeaveTypes(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                    'name'=>'required',
                    'is_no_pay'=>'required',
                    'description'=>'required',
            ]);

            $leavetypes = LeaveType::find($id);
            $leavetypes->name = $request->name;
            $leavetypes->is_no_pay = $request->is_no_pay;
            $leavetypes->description = $request->description;
            $leavetypes->save();
        
            DB::commit();

            return response()->json([
                "msg" => "leavetypes Data",
                "data"=> $leavetypes,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
        }

    public function destroyLeaveTypes($id)
    {
        try{
                $leavetypes = LeaveType::find($id);
                $leavetypes ->delete();

            }
            catch(\Throwable $e){
            return response()->json([
                "message"=>"Ooops Something went wrong please try again",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
}
