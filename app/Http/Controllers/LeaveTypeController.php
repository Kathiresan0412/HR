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


    /**
     * Display the specified resource.
     */
    public function show(LeaveType $leaveType)
    {
        //
    }

    public function getAll(Request $request)
    {
        try {
            $leaveTypes = DB::table('leave_types as t')
                ->select('t.id', 't.name', 't.is_no_pay', 't.description');

            $search = $request->search;

            if (!is_null($search)) {
                $leaveTypes = $leaveTypes
                    ->where('t.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('t.is_no_pay', 'LIKE', '%' . $search . '%')
                    ->orWhere('t.description', 'LIKE', '%' . $search . '%');
            }


            $filterParameters = [
                'is_no_pay' => 't.is_no_pay',
                'description' => 't.description',

            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $leaveTypes->where($column, '=', $value);
                }
            }
            $leaveTypes = $leaveTypes->orderBy('t.created_at', 'desc')->get();

            return response()->json([
                "Message" => " All Leavetypes Data",
                "Data" => $leaveTypes,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }


    public function getOne($id)
    {
        try {

            $leaveType = DB::table('leave_types as t')
                ->select('t.id', 't.name', 't.is_no_pay', 't.description');


            $leaveType = $leaveType->orderBy('t.created_at', 'desc')
                ->where('t.id', $id)
                ->first();

            return response()->json([
                "Message" => "Leavetype Data",
                "Data" => $leaveType,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Oops something went wrong",
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
                'is_no_pay' => 'required',
                'description' => 'required',
            ]);

            $leaveType = new LeaveType();
            $leaveType->name = $request->name;
            $leaveType->is_no_pay = $request->is_no_pay;
            $leaveType->description = $request->description;
            $leaveType->save();

            DB::commit();

            return response()->json([
                "Message" => "Leavetypes Data Saved",
                "Data" => $leaveType,
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
                'is_no_pay' => 'required',
                'description' => 'required',
            ]);

            $leaveType = LeaveType::find($id);
            $leaveType->name = $request->name;
            $leaveType->is_no_pay = $request->is_no_pay;
            $leaveType->description = $request->description;
            $leaveType->save();

            DB::commit();

            return response()->json([
                "Message" => "Leavetypes Data Updated",
                "Data" => $leaveType,
            ], 200);
        } catch (\Throwable $e) {

            DB::rollback();

            return response()->json([
                "Message" => "Oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $leavetype = LeaveType::find($id);
            $leavetype->delete();
            return response()->json([
                "Message" => "LeaveTypes Data Deleted",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Oops Something went wrong please try again",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
}
