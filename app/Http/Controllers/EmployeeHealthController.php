<?php

namespace App\Http\Controllers;

use App\Models\EmployeeHealth;
use Illuminate\Http\Request;
use DB;

class EmployeeHealthController extends Controller
{

    public function getAll(Request $request)
    {
        try {
            $employeeHealths = DB::table('employee_healths as eh')
                ->select('eh.id', 'e.first_name as employee', 'eh.medical_examination_date', 'eh.medical_condition', 'eh.Doctor_notes', 'eh.allergies', 'eh.prescription_details')
                ->leftJoin('employees as e', 'e.id', '=', 'eh.employee');


            $search = $request->search;
            if (!is_null($search)) {
                $employeeHealths = $employeeHealths
                    ->where('eh.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.medical_examination_date', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.medical_condition', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.Doctor_notes', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.allergies', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.prescription_details', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'medical_examination_date' => 'eh.medical_examination_date',
                'medical_condition' => 'eh.medical_condition',

            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $employeeHealths->where($column, '=', $value);
                }
            }
            $employeeHealths = $employeeHealths->orderBy('eh.created_at', 'desc')->get();
            return response()->json([
                "message" => "All Employee Healths Data",
                "data" => $employeeHealths,
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
                'employee' => 'required',
                'medical_examination_date' => 'required',
                'medical_condition' => 'required',
                'Doctor_notes' => 'required',
                'allergies' => 'required',
                'prescription_details' => 'required'
            ]);


            $employeeHealth = new EmployeeHealth();
            $employeeHealth->employee = $request->employee;
            $employeeHealth->medical_examination_date = $request->medical_examination_date;
            $employeeHealth->medical_condition = $request->medical_condition;
            $employeeHealth->Doctor_notes = $request->Doctor_notes;
            $employeeHealth->allergies = $request->allergies;
            $employeeHealth->prescription_details = $request->prescription_details;
            $employeeHealth->save();

            DB::commit();

            return response()->json([
                "msg" => "Employee Health Data Saved",
                "data" => $employeeHealth,
            ], 200);
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
            $employeeHealth = DB::table('employee_healths as eh')
                ->select('eh.id', 'e.first_name as employee', 'eh.medical_examination_date', 'eh.medical_condition', 'eh.Doctor_notes', 'eh.allergies', 'eh.prescription_details')
                ->leftJoin('employees as e', 'e.id', '=', 'eh.employee')
                ->where('eh.id', $id)
                ->first();

            return response()->json([
                "message" => "Employee Health Data",
                "data" => $employeeHealth,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
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
                'medical_examination_date' => 'required',
                'medical_condition' => 'required',
                'Doctor_notes' => 'required',
                'allergies' => 'required',
                'prescription_details' => 'required'
            ]);
            $employeeHealth = EmployeeHealth::find($id);
            $employeeHealth->employee = $request->employee;
            $employeeHealth->medical_examination_date = $request->medical_examination_date;
            $employeeHealth->medical_condition = $request->medical_condition;
            $employeeHealth->Doctor_notes = $request->Doctor_notes;
            $employeeHealth->allergies = $request->allergies;
            $employeeHealth->prescription_details = $request->prescription_details;
            $employeeHealth->save();

            DB::commit();
            return response()->json([
                "msg" => "Employee Health Data Updated",
                "data" => $employeeHealth,
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
            $employeeHealth = EmployeeHealth::find($id);
            $employeeHealth->delete();

            return response()->json([
                "message" => "Employee Health Data Deleted"
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}