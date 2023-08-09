<?php

namespace App\Http\Controllers;

use App\Models\Resignation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResignationController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $resignations = DB::table('resignations as re')
                ->select('re.id', 'e.first_name as employee', 're.gratuity', 're.type', 're.reason', 're.resign_status', 're.resigned_date')
                ->leftJoin('employees as e', 'e.id', '=', 're.employee');

            $search = $request->search;
            if (!is_null($search) ) {
                $resignations = $resignations
                    ->where('re.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('re.gratuity', 'LIKE', '%' . $search . '%')
                    ->orWhere('re.type', 'LIKE', '%' . $search . '%')
                    ->orWhere('re.reason', 'LIKE', '%' . $search . '%')
                    ->orWhere('re.resign_status', 'LIKE', '%' . $search . '%')
                    ->orWhere('re.resigned_date', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'gratuity' => 're.gratuity',
                'resign_status' => 're.resign_status',
                'resigned_date' => 're.resigned_date',

            ];
    
            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $resignations->where($column, '=', $value);
                }
            }

            $resignations = $resignations->orderBy('re.created_at', 'desc')->get();

            return response()->json([
                "message" => "All Resignation Data",
                "data" => $resignations,
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
            $resignation = DB::table('resignations as re')
                ->select('re.id', 'e.first_name as employee', 're.gratuity', 're.type', 're.reason', 're.resign_status', 're.resigned_date')
                ->leftJoin('employees as e', 'e.id', '=', 're.employee')
                ->where('re.id', $id)
                ->first();

            return response()->json([
                "message" => " Attendance Data",
                "data" => $resignation
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
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'gratuity' => 'required',
                'type' => 'required',
                'reason' => 'required',
                'resigned_date' => 'required',
            ]);

            $resignation = new Resignation();
            $resignation->employee = $request->employee;
            $resignation->gratuity = $request->gratuity;
            $resignation->type = $request->type;
            $resignation->reason = $request->reason;
            $resignation->resign_status = $request->resign_status;
            $resignation->resigned_date = $request->resigned_date;
            $resignation->save();

            DB::commit();

            return response()->json([
                "msg" => " Resignation Data Saved",
                "data" => $resignation,
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
                'gratuity' => 'required',
                'type' => 'required',
                'reason' => 'required',
                'resigned_date' => 'required',
            ]);

            $resignation =  Resignation::find($id);
            $resignation->employee = $request->employee;
            $resignation->gratuity = $request->gratuity;
            $resignation->type = $request->type;
            $resignation->reason = $request->reason;
            $resignation->resign_status = $request->resign_status;
            $resignation->resigned_date = $request->resigned_date;
            $resignation->save();

            DB::commit();
            return response()->json([
                "msg" => "  Resignation Data Updated",
                "data" => $resignation
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
            $resignation = Resignation::find($id);
            $resignation->delete();
            return response()->json([
                "msg" => "  Resignation Data Deleted",
    
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
