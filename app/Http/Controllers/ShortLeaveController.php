<?php

namespace App\Http\Controllers;

use App\Models\ShortLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShortLeaveController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $shortLeaves = DB::table('short_leaves as s')
                ->select('s.id', 'e.id as employee', 's.date', 's.time_from', 's.time_to', 's.note')
                ->leftJoin('employees as e', 'e.id', '=', 's.employee');

            $search = $request->search;

            if (!is_null($search)) {
                $shortLeaves = $shortLeaves
                    ->where('employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('s.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('s.note', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'date' => 's.date',
                'time_from' => 's.time_from',
                'time_to' => 's.time_to',
            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $shortLeaves->where($column, '=', $value);
                }
            }
            $shortLeaves = $shortLeaves->orderBy('s.created_at', 'desc')->get();
            return response()->json([
                "message" => "All Short Leave Data",
                "data" => $shortLeaves
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function getOne($id)
    {
        try {
            $shortLeave = DB::table('short_leaves as s')
                ->select('s.id', 'e.id as employee', 's.date', 's.time_from', 's.time_to', 's.note')
                ->leftJoin('employees as e', 'e.id', '=', 's.employee')
                ->where('s.id', $id)
                ->first();

            return response()->json([
                "message" => "Short Leave Data",
                "data" => $shortLeave,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'date' => 'required',
                'time_from' => 'required',
                'time_to' => 'required',
                'note' => 'required'
            ]);

            $shortLeave = new ShortLeave();
            $shortLeave->employee = $request->employee;
            $shortLeave->date = $request->date;
            $shortLeave->time_from = $request->time_from;
            $shortLeave->time_to = $request->time_to;
            $shortLeave->note = $request->note;
            $shortLeave->save();

            DB::commit();

            return response()->json([
                "msg" => "Short Leave Data Saved",
                "data" => $shortLeave
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'date' => 'required',
                'time_from' => 'required',
                'time_to' => 'required',
                'note' => 'required'
            ]);

            $shortLeave = ShortLeave::find($id);
            $shortLeave->employee = $request->employee;
            $shortLeave->date = $request->date;
            $shortLeave->time_from = $request->time_from;
            $shortLeave->time_to = $request->time_to;
            $shortLeave->note = $request->note;
            $shortLeave->save();

            DB::commit();

            return response()->json([
                "msg" => "Short Leave Data Updated",
                "data" => $shortLeave
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function delete($id)
    {
        try {
            $shortLeave = ShortLeave::find($id);
            $shortLeave->delete();

            return response()->json([
                "msg" => "Short Leave Data Deleted",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}