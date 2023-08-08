<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;

use App\Models\AllowedLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllowedLeaveController extends Controller
{
   
    public function getAll(Request $request)
    {
        try {
            $allowedleaves = DB::table('allowed_leaves as l')
                ->select('l.id', 'p.name as position', 't.name as type', 'l.days', 'l.term')
                ->leftJoin('positions as p', 'p.id', '=', 'l.position')
                ->leftJoin('leave_types as t', 't.id', '=', 'l.type');

                $filterParameters = [
                    'term' => 'l.term', 
                    'position' => 'l.position',    
                    'type' => 'l.type',    

                ];

                foreach ($filterParameters as $parameter => $column) {
                    $value = $request->input($parameter);
                    if (isset($value) && $value !== '') {
                        $allowedleaves->where($column, '=', $value);
                    }
                }
                
            
            $search = $request->search;
            if (!is_null($search)) {
                $allowedleaves = $allowedleaves
                    ->where('l.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.position', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.type', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.days', 'LIKE', '%' . $search . '%')
                    ->orWhere('l.term', 'LIKE', '%' . $search . '%');
                    
            }
            $allowedleaves = $allowedleaves->orderBy('l.created_at', 'desc')->get();
            return response()->json([
                "message" => "Allowed Leave Data",
                "data" => $allowedleaves,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function getOne($id)
    {
        try {

            $allowedleave = DB::table('allowed_leaves as l')
                ->select('l.id', 'p.name as position', 't.name as type', 'l.days', 'l.term')
                ->leftJoin('positions as p', 'p.id', '=', 'l.position')
                ->leftJoin('leave_types as t', 't.id', '=', 'l.type')
                ->where('l.id', $id)
                ->first();

            return response()->json([
                "message" => "Allowed Leave Data",
                "data" => $allowedleave,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function save(Request $request)
    {
        try {
            $request->validate([
                'position' => 'required',
                'type' => 'required',
                'term' => 'required',
            ]);

            $allowedleave = new AllowedLeave();
            $allowedleave->position = $request->position;
            $allowedleave->type = $request->type;
            $allowedleave->days = $request->days;
            $allowedleave->term = $request->term;
            $allowedleave->save();

            DB::commit();

            return response()->json([
                "msg" => "Allowed Leaves Data Saved",
                "data" => $allowedleave,
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
                'position' => 'required',
                'term' => 'required',
                'type' => 'required',
            ]);

            $allowedleave = AllowedLeave::find($id);
            $allowedleave->position = $request->position;
            $allowedleave->type = $request->type;
            $allowedleave->days = $request->days;
            $allowedleave->term = $request->term;
            $allowedleave->save();

            DB::commit();

            return response()->json([
                "msg" => "Allowed Leave Data",
                "data" => $allowedleave,
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
            $allowedleave = AllowedLeave::find($id);
            $allowedleave->delete();
            return response()->json([
                "message" => "Allowed leave record deleted successfully",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
