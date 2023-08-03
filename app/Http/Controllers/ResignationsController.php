<?php

namespace App\Http\Controllers;

use App\Models\Resignations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResignationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $resignations = DB::table('resignations as re')
           ->select('re.id','e.first_name as employee','re.gratuity','re.type','re.reason','re.resign_status','re.resigned_date')
           ->leftJoin('employees as e', 'e.id', '=', 're.employee');

           $search = $request->search;
           if (!is_null($search)){
               $resignations = $resignations
               ->where('re.id','LIKE','%'.$search.'%')
               ->orWhere('re.gratuity','LIKE','%'.$search.'%')
               ->orWhere('re.type','LIKE','%'.$search.'%')
               ->orWhere('re.reason','LIKE','%'.$search.'%')
               ->orWhere('re.resign_status','LIKE','%'.$search.'%')
               ->orWhere('re.resigned_date','LIKE','%'.$search.'%');


           }
           $resignations = $resignations->orderBy('re.id','desc')->get();

           return response()->json([
               "message" => "attendances Data",
               "data" => $resignations,
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
                'gratuity'=>'required',
                'type'=>'required',
                'reason'=>'required',
                'resign_status'=>'required',
                'resigned_date'=>'required',
                'status'=>'required'
            ]);
   
            $resignations = new Resignations();
            $resignations->employee = $request->employee;
            $resignations->gratuity = $request->gratuity;
            $resignations->type = $request->type;
            $resignations->reason = $request->reason;
            $resignations->resign_status = $request->resign_status;
            $resignations->resigned_date = $request->resigned_date;
            $resignations->status = $request->status;
   
            $resignations->save();
            //Resignations::where('attendances',$id)->delete();
   
            DB::commit();
   
            return response()->json([
                "msg" => " create resignation Data",
                "data"=> $resignations,
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
    public function show(Resignations $resignations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        try {
            $resignations = DB::table('resignations as re')
            ->select('re.id','e.first_name as employee','re.gratuity','re.type','re.reason','re.resign_status','re.resigned_date')
            ->leftJoin('employees as e', 'e.id', '=', 're.employee')
           ->where('re.id',$id)
           ->first();



           return response()->json([
               "message" => "attendances Data",
               "data" => $resignations,
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
        DB::beginTransaction();
        try{
            $request->validate([
                'employee'=>'required',
                'gratuity'=>'required',
                'type'=>'required',
                'reason'=>'required',
                'resign_status'=>'required',
                'resigned_date'=>'required',
                'status'=>'required'
            ]);
   
            $resignations =  Resignations::find($id);
            $resignations->employee = $request->employee;
            $resignations->gratuity = $request->gratuity;
            $resignations->type = $request->type;
            $resignations->reason = $request->reason;
            $resignations->resign_status = $request->resign_status;
            $resignations->resigned_date = $request->resigned_date;
            $resignations->status = $request->status;
   
            $resignations->save();
            //Resignations::where('attendances',$id)->delete();
            DB::commit();
            return response()->json([
                "msg" => " Update resignation Data",
                "data"=> $resignations,
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
        try {
            $resignations = Resignations::find($id);
            $resignations->delete();
    
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
        
    }
}
