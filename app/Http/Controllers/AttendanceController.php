<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $attendances = DB::table('attendances as at')
                ->select('at.id', 'at.date', 'e.first_name as employee', 'e.bio_code as bio_code', 'at.start_time', 'at.end_time', 'at.worked_hrs', 'at.work_shift_tot_hrs', 'at.status')
                ->leftJoin('employees as e', 'e.id', '=', 'at.employee');

            $search = $request->search;

            if (!is_null($search)) {
                $attendances = $attendances
                    ->where('at.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('at.date', 'LIKE', '%' . $search . '%')
                    ->orWhere('at.employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('at.start_time', 'LIKE', '%' . $search . '%')
                    ->orWhere('at.end_time', 'LIKE', '%' . $search . '%')
                    ->orWhere('at.worked_hrs', 'LIKE', '%' . $search . '%')
                    ->orWhere('at.work_shift_tot_hrs', 'LIKE', '%' . $search . '%')
                    ->orWhere('at.status', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'date' => 'at.date',
                'start_time' => 'at.start_time',
                'end_time' => 'at.end_time',
                'status' => 'at.status'
            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $attendances->where($column, '=', $value);
                }
            }

            $attendances = $attendances->orderBy('at.created_at', 'desc')->get();

            return response()->json([
                "message" => "All Attendence Data",
                "data" => $attendances
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
            $attendance = DB::table('attendances as at')
                ->select('at.id', 'at.date', 'e.first_name as employee', 'e.bio_code as bio_code', 'at.start_time', 'at.end_time', 'at.worked_hrs', 'at.work_shift_tot_hrs', 'at.status')
                ->leftJoin('employees as e', 'e.id', '=', 'at.employee')
                ->where('at.id', $id)
                ->first();

            return response()->json([
                "message" => "Attendence Data",
                "data" => $attendance
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
                'start_time' => 'required',
                'end_time' => 'required',
                'worked_hrs' => 'required',
                'work_shift_tot_hrs' => 'required',
                'status' => 'required'
            ]);

            $attendance = new Attendance();
            $attendance->employee = $request->employee;
            $attendance->date = $request->date;
            $attendance->start_time = $request->start_time;
            $attendance->end_time = $request->end_time;
            $attendance->worked_hrs = $request->worked_hrs;
            $attendance->work_shift_tot_hrs = $request->work_shift_tot_hrs;
            $attendance->status = $request->status;
            $attendance->save();

            DB::commit();

            return response()->json([
                "msg" => "Attendance Data Saved",
                "data" => $attendance
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage()
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
                'start_time' => 'required',
                'end_time' => 'required',
                'worked_hrs' => 'required',
                'work_shift_tot_hrs' => 'required',
                'status' => 'required'
            ]);

            $attendance = Attendance::find($id);
            $attendance->employee = $request->employee;
            $attendance->date = $request->date;
            $attendance->start_time = $request->start_time;
            $attendance->end_time = $request->end_time;
            $attendance->worked_hrs = $request->worked_hrs;
            $attendance->work_shift_tot_hrs = $request->work_shift_tot_hrs;
            $attendance->status = $request->status;
            $attendance->save();

            DB::commit();

            return response()->json([
                "msg" => "Attendance Data Updated",
                "data" => $attendance
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function delete($id)
    {
        try {
            $attendance = Attendance::find($id);
            $attendance->delete();

            return response()->json([
                "msg" => "Attendance Data Deleted",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}