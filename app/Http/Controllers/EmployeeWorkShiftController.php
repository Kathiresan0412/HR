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
                ->select('ews.id', 'e.first_name as employee', 'ews.title', 'ews.date', 'ews.is_of_hour', 'ews.is_of_day')
                // ->leftJoin('employee_work_shifts as ews','ews.id','=','wsd.work_shif_id')
                ->leftJoin('employees as e', 'e.id', '=', 'ews.employee');

            $employeeWorkShifts = $employeeWorkShifts->orderBy('ews.created_at', 'desc')->get();
            $filterParameters = [
                'date' => 're.date',
                'is_of_hour' => 'ews.is_of_hour',
                'is_of_day' => 'ews.is_of_day',

            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $employeeWorkShifts->where($column, '=', $value);
                }
            }
            $search = $request->search;
            if (!is_null($search)) {
                $promotions = $employeeWorkShifts
                    ->where('ews.employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('ews.previous_position', 'LIKE', '%' . $search . '%')
                  //  ->orWhere('p.current_position', 'LIKE', '%' . $search . '%')
                    ->orWhere('ews.status', 'LIKE', '%' . $search . '%');
            }
            $promotions = $promotions->orderBy('p.created_at', 'desc')->get();

            return response()->json([
                "message" => "All work shift Data",
                "data" => $employeeWorkShifts,
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
            $employeeWorkShift->is_of_day = $request->is_of_day;
            $employeeWorkShift->is_of_hour = $request->is_of_hour;
            $employeeWorkShift->save();
            $workshift = $employeeWorkShift->id;
           
            $work_shift_details = $request->work_shift_details;   
            foreach ($work_shift_details as $shift) {
             
                $workShiftDetail = new WorkShiftDetail();
                $workShiftDetail->work_shif_id = $workshift;
                $workShiftDetail->from = $shift["from"];
                $workShiftDetail->to = $shift["to"];
                $workShiftDetail->save();
            }

            DB::commit();

            return response()->json([
                "msg" => "allowedleaves Data",
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

    public function getOne($id)
    {
        try {
            $wmployeeWorkShift = DB::table('employee_work_shifts as ews')
                ->select('ews.id', 'e.first_name as employee', 'ews.title', 'ews.date', 'ews.is_of_hour', 'ews.is_of_day')
                // ->leftJoin('employee_work_shifts as ews','ews.id','=','wsd.work_shif_id')
                ->leftJoin('employees as e', 'e.id', '=', 'ews.employee');
            $wmployeeWorkShift = $wmployeeWorkShift->orderBy('ews.id', 'desc')->get()
                ->where('ews.id', $id)
                ->first();


            $wmployeeWorkShift = DB::table('work_shift_details as wsd')
                ->select('wse.id', 'e.first_name as employee', 'ews.title as title', 'ews.date as date', 'ews.date as date', 'ews.is_of_hour as is_of_hour', 'ews.is_of_day as is_of_day', 'wsd.from', 'wsd.to')
                ->leftJoin('employee_work_shifts as ews', 'ews.id', '=', 'wsd.work_shif_id');
            $wmployeeWorkShift = $wmployeeWorkShift->orderBy('l.id', 'desc')->get()->where('id', 'ews.id')->first();

            //    $EmployeeWorkShift =[];
            // foreach ($EmployeeWorkShift as $WorkShift) {
            //     array_push($company_managers, $com_manager->manager);}

            return response()->json([
                "message" => "work shift Data",
                "data" => $wmployeeWorkShift,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'title' => 'required',
                'employee' => 'required',
                'date' => 'required',

            ]);
            $employeeWorkShift =  EmployeeWorkShift::find($id);
            $employeeWorkShift->title = $request->title;
            $employeeWorkShift->employee = $request->employee;
            $employeeWorkShift->date = $request->date;
            $employeeWorkShift->is_of_day = $request->is_of_day;
            $employeeWorkShift->is_of_hour = $request->is_of_hour;
            $employeeWorkShift->save();
           
            WorkShiftDetail::where('work_shif_id', $id)->delete();
          $work_shift_details = $request->work_shift_details;   
          foreach ($work_shift_details as $shift) {
           
              $workShiftDetail = new WorkShiftDetail();
              $workShiftDetail->work_shif_id = $id;
              $workShiftDetail->from = $shift["from"];
              $workShiftDetail->to = $shift["to"];
              $workShiftDetail->save();
            }
            DB::commit();

            return response()->json([
                "msg" => "Work Shift Detail  Data Updated",
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
        try {
            $workShiftDetail = WorkShiftDetail::find($id);
            $workShiftDetail->delete();
             return response()->json([
                "msg" => "Work Shift Detail Data Deleted",
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
