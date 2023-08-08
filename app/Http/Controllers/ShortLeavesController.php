<?php

namespace App\Http\Controllers;

use App\Models\ShortLeaves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShortLeavesController extends Controller
{


    public function show(ShortLeaves $shortLeaves)
    {
        //
    }
    public function index(Request $request)
    {
        try{
            $shortLeaves = DB::table('short_leaves as s')
            ->select('s.id','e.id as employee','s.date','s.time_from','s.time_to','s.note')
            ->leftJoin('employees as e', 'e.id', '=', 's.employee');
            $search = $request->search;
            if (!is_null($search)){
                $shortLeaves = $shortLeaves
                ->where('e.id','LIKE','%'.$search.'%')
                ->where('employee','LIKE','%'.$search.'%')
                ->orWhere('s.id','LIKE','%'.$search.'%')
                ->orWhere('s.note','LIKE','%'.$search.'%');
            }
            $shortLeaves = $shortLeaves->orderBy('s.id','desc')->get();
            return response()->json([
                "message" => "Short Leaves Data",
                "data" => $shortLeaves,
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

            $shortLeaves = DB::table('short_leaves as s')
            ->select('s.id','e.id as employee','s.date','s.time_from','s.time_to','s.note')
            ->leftJoin('employees as e', 'e.id', '=', 's.employee')
            ->where('s.id',$id)
            ->first();

            return response()->json([
                "message" => "shortLeave Data",
                "data" => $shortLeaves,
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
                'date'=>'required',
                'time_from'=>'required',
                'time_to'=>'required',
                'note'=>'required'
            ]);

            $shortLeaves = new ShortLeaves();
            $shortLeaves->employee = $request->employee;
            $shortLeaves->date = $request->date;
            $shortLeaves->time_from = $request->time_from;
            $shortLeaves->time_to = $request->time_to;
            $shortLeaves->note = $request->note;
            $shortLeaves->save();

            DB::commit();

            return response()->json([
                "msg" => "shortLeaves Data",
                "data"=> $shortLeaves,
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
                'time_from'=>'required',
                'time_to'=>'required',
                'note'=>'required'
            ]);
            $shortLeaves = ShortLeaves::find($id);
            $shortLeaves->employee = $request->employee;
            $shortLeaves->date = $request->date;
            $shortLeaves->time_from = $request->time_from;
            $shortLeaves->time_to = $request->time_to;
            $shortLeaves->note =$request->note;
            $shortLeaves->save();  
            DB::commit();
            return response()->json([
            "msg" => "shortLeaves Data",
            "data"=> $shortLeaves,
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
        try{
                $shortLeaves = ShortLeaves::find($id);
                $shortLeaves ->delete();
            }
            catch(\Throwable $e){
            return response()->json([
                "message"=>"Ooops Something went wrong please try again",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
}
