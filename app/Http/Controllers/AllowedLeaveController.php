<?php

namespace App\Http\Controllers;

use App\Models\AllowedLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllowedLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    /**
     * Display the specified resource.
     */
    public function show(AllowedLeave $allowedLeave)
    {
        //
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'position' => 'required',
                'type' => 'required',
                'term' => 'required',
                // 'count'=>'required',
            ]);
            $allowedleaves = AllowedLeave::find($id);
            $allowedleaves->position = $request->position;
            $allowedleaves->type = $request->type;
            $allowedleaves->days = $request->days;
            $allowedleaves->term = $request->term;
            //$allowedleaves->count = $request->count;
            $allowedleaves->save();
            DB::commit();
            return response()->json([
                "msg" => "allowedleaves Data",
                "data" => $allowedleaves,
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $allowedleaves = AllowedLeave::find($id);
            $allowedleaves->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function index(Request $request)
    {
        try {
            $allowedleaves = DB::table('allowed_leaves as l')
                ->select('l.id', 'p.name as position', 't.name as type', 'l.days', 'l.term')
                ->leftJoin('positions as p', 'p.id', '=', 'l.position')
                ->leftJoin('leave_types as t', 't.id', '=', 'l.type');

//Filter
            $search = $request->search;
            if (!is_null($search)) {
                $allowedleaves = $allowedleaves
                    ->where('l.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.position', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.type', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.days', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.term', 'LIKE', '%' . $search . '%');
                    
            }
            $allowedleaves = $allowedleaves->orderBy('l.id', 'desc')->get();
            return response()->json([
                "message" => "allowedleaves Data",
                "data" => $allowedleaves,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function edit($id)
    {
        try {

            $allowedleaves = DB::table('allowed_leaves as l')
                ->select('l.id', 'p.name as position', 't.name as type', 'l.days', 'l.term')
                ->leftJoin('positions as p', 'p.id', '=', 'l.position')
                ->leftJoin('leave_types as t', 't.id', '=', 'l.type')
                ->where('l.id', $id)
                ->first();

            return response()->json([
                "message" => "allowedleaves Data",
                "data" => $allowedleaves,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'position' => 'required',
                'type' => 'required',
                'term' => 'required',
                //'count'=>'required',
            ]);

            $allowedleaves = new AllowedLeave();
            $allowedleaves->position = $request->position;
            $allowedleaves->type = $request->type;
            $allowedleaves->days = $request->days;
            $allowedleaves->term = $request->term;
            // $allowedleaves->count = $request->count;
            $allowedleaves->save();

            DB::commit();

            return response()->json([
                "msg" => "allowedleaves Data",
                "data" => $allowedleaves,
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
