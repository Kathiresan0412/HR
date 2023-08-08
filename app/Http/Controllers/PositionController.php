<?php

namespace App\Http\Controllers;

use App\Models\position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        try {
            $positions = DB::table('positions as p')
                ->select('p.id', 'p.name', 'p.type', 'p.workable_time', 'p.workable_time_period', 'p.description');
            $search = $request->search;
            $type = $request->type;
            if (!is_null($search) &&($type!="")) {
                $positions = $positions->where('p.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('p.type', 'LIKE', '%' . $search . '%')
                    ->orWhere('p.workable_time', 'LIKE', '%' . $search . '%')
                    ->orWhere('p.workable_time_period', 'LIKE', '%' . $search . '%')
                    ->orWhere('p.description', 'LIKE', '%' . $search . '%');
            }
            $positions = $positions->orderBy('p.id', 'desc')->get();

            return response()->json([
                "message" => "position Data",
                "data" => $positions,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Something went wrong",
                "error" => $e->getMessage(),
            ], 500);
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
        try {
            $request->validate([
                'name' => 'required',
                'type' => 'required',
                'workable_time' => 'required',
                'workable_time_period' => 'required',
                'description' => 'required'
            ]);

            $position = new Position();
            $position->name = $request->name;
            $position->type = $request->type;
            $position->workable_time = $request->workable_time;
            $position->workable_time_period = $request->workable_time_period;
            $position->description = $request->description;
            $position->save();

            DB::commit();

            return response()->json([
                "msg" => "Position Data",
                "data" => $position,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $position = DB::table('positions as p')
                ->select('p.id', 'p.name', 'p.type', 'p.workable_time', 'p.workable_time_period', 'p.description')
                ->where('p.id', $id)
                ->first();
            return response()->json([
                "message" => "Position Data",
                "data" => $position,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destory($id)
    {
        try {
            $positions = Position::find($id);
            $positions->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'type' => 'required',
                'workable_time' => 'required',
                'workable_time_period' => 'required',
                'description' => 'required'
            ]);
            $position = Position::find($id);
            $position->name = $request->name;
            $position->type = $request->type;
            $position->workable_time = $request->workable_time;
            $position->workable_time_period = $request->workable_time_period;
            $position->description = $request->description;
            $position->save();
            DB::commit();
            return response()->json([
                "msg" => "Position Data",
                "data" => $position,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
