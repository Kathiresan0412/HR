<?php
namespace App\Http\Controllers;

use App\Models\WorkShiftDetail;
use App\Models\EmployeeWorkShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeWorkShiftController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $employeeWorkShifts = DB::table('employee_work_shifts as ews')
                ->select('ews.id', 'e.first_name as employee', 'ews.title', 'ews.date', 'ews.is_off_hour', 'ews.is_off_day')
                ->leftJoin('employees as e', 'e.id', '=', 'ews.employee');

            $search = $request->search;
            if (!is_null($search)) {
                $employeeWorkShifts = $employeeWorkShifts
                    ->where('ews.employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('ews.title', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'date' => 'ews.date',
                'is_off_hour' => 'ews.is_off_hour',
                'is_off_day' => 'ews.is_off_day',
                'title' => 'ews.title',
            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $employeeWorkShifts->where($column, '=', $value);
                }
            }
            $employeeWorkShifts = $employeeWorkShifts->orderBy('ews.created_at', 'desc')->get();

            return response()->json([
                "message" => "All Work Shift Data",
                "data" => $employeeWorkShifts,
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
            $wmployeeWorkShift = DB::table('employee_work_shifts as ews')
                ->select('ews.id', 'e.first_name as employee', 'ews.title', 'ews.date', 'ews.is_off_hour', 'ews.is_off_day')
                ->leftJoin('employees as e', 'e.id', '=', 'ews.employee')
                ->where('ews.id', $id)
                ->first();

            $WorkShifts = DB::table('work_shift_details as wsd')
                ->select('wsd.id', 'wsd.work_shift_id', 'wsd.from', 'wsd.to')
                ->where('wsd.work_shift_id', $id)
                ->get();

            $WorkShiftFrom = [];
            foreach ($WorkShifts as $WorkShift) {
                array_push($WorkShiftFrom, $WorkShift->from);
            }
            $WorkShiftTo = [];
            foreach ($WorkShifts as $WorkShift) {
                array_push($WorkShiftTo, $WorkShift->to);
            }
            $combinedWorkShifts = array_map(function ($from, $to) {
                return ['from' => $from, 'to' => $to];
            }, $WorkShiftFrom, $WorkShiftTo);

            return response()->json([
                "message" => "Work Shift Data",
                "data" => $wmployeeWorkShift,
                "data work shift" => $combinedWorkShifts
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
                'title' => 'required',
                'employee' => 'required',
                'date' => 'required',
            ]);
            $employeeWorkShift = new EmployeeWorkShift();
            $employeeWorkShift->title = $request->title;
            $employeeWorkShift->employee = $request->employee;
            $employeeWorkShift->date = $request->date;
            $employeeWorkShift->is_off_day = $request->is_off_day;
            $employeeWorkShift->is_off_hour = $request->is_off_hour;
            $employeeWorkShift->save();
            $workshift = $employeeWorkShift->id;

            $work_shift_details = $request->work_shift_details;
            foreach ($work_shift_details as $shift) {

                $workShiftDetail = new WorkShiftDetail();
                $workShiftDetail->work_shift_id = $workshift;
                $workShiftDetail->from = $shift["from"];
                $workShiftDetail->to = $shift["to"];
                $workShiftDetail->save();
            }

            DB::commit();

            return response()->json([
                "msg" => "Employee Work Shift Data Saved",
                "data" => $employeeWorkShift,
            ], 201);
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
        try {
            $request->validate([
                'title' => 'required',
                'employee' => 'required',
                'date' => 'required',
            ]);

            $employeeWorkShift = EmployeeWorkShift::find($id);
            $employeeWorkShift->title = $request->title;
            $employeeWorkShift->employee = $request->employee;
            $employeeWorkShift->date = $request->date;
            $employeeWorkShift->is_off_day = $request->is_off_day;
            $employeeWorkShift->is_off_hour = $request->is_off_hour;
            $employeeWorkShift->save();

            WorkShiftDetail::where('work_shift_id', $id)->delete();
            $work_shift_details = $request->work_shift_details;
            foreach ($work_shift_details as $shift) {
                $workShiftDetail = new WorkShiftDetail();
                $workShiftDetail->work_shift_id = $id;
                $workShiftDetail->from = $shift["from"];
                $workShiftDetail->to = $shift["to"];
                $workShiftDetail->save();
            }

            DB::commit();

            return response()->json([
                "msg" => "Employee Work Shift Data Updated",
                "data" => $employeeWorkShift,
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
        //Need to be Discuss
        try {
            $workShiftDetail = WorkShiftDetail::find($id);
            $workShiftDetail->delete();
            return response()->json([
                "msg" => "Employee Work Shift Data Deleted",
                "data" => $workShiftDetail,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}