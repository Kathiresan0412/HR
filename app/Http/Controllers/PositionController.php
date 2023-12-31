<?php

namespace App\Http\Controllers;

use App\Models\position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $positions = DB::table('positions as p')
                ->select('p.id', 'p.name', 'p.type', 'p.workable_time', 'p.workable_time_period', 'p.description');

            $search = $request->search;

            if (!is_null($search)) {
                $positions = $positions
                    ->where('p.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('p.type', 'LIKE', '%' . $search . '%')
                    ->orWhere('p.description', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'name' => 'p.name',
                'type' => 'p.type',
            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $positions->where($column, '=', $value);
                }
            }

            $positions = $positions->orderBy('p.created_at', 'desc')->get();

            return response()->json([
                "Message" => "All Position Data",
                "Data" => $positions,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
    public function getOne($id)
    {
        try {
            $position = DB::table('positions as p')
                ->select('p.id', 'p.name', 'p.type', 'p.workable_time', 'p.workable_time_period', 'p.description');

            $position = $position->orderBy('p.created_at', 'desc')
                ->where('p.id', $id)
                ->first();

            return response()->json([
                "Message" => "Position Data",
                "Data" => $position,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
    public function save(Request $request)
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
                "Message" => "Position Data Saved",
                "Data" => $position
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "Message" => "Oops something went wrong",
                "Error" => $e->getMessage(),
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
                "Message" => "Position Data Updated",
                "Data" => $position
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
    public function delete($id)
    {
        try {
            $position = Position::find($id);
            $position->delete();
            return response()->json([
                "Message" => "Position Data Deleted"
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Ooops Something went wrong please try again",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
}