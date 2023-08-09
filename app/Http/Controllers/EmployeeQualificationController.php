<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeQualificationController extends Controller
{
    public function getAll(Request $request, )
    {
        try {
            $employeeQualifications = DB::table('employee_qualifications as eq')
                ->select('eq.id', 'emp.first_name as employee ', 'qu.name as qualification')
                ->leftJoin('employees as emp', 'emp.id', '=', 'eq.employee')
                ->leftJoin('qualifications as qu', 'qu.id', '=', 'eq.qualification');

            $search = $request->search;
            if (!is_null($search)) {
                $employeeQualifications = $employeeQualifications
                    ->where('eq.qualification', 'LIKE', '%' . $search . '%')
                    ->orwhere('eq.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('eq.employee', 'LIKE', '%' . $search . '%');
            }
            $filterParameters = [
                'qualification' => 'eq.qualification',
                'employee' => 'eq.employee',

            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $employeeQualifications->where($column, '=', $value);
                }
            }

            $employeeQualifications = $employeeQualifications->orderBy('eq.created_at', 'desc')->get();

            return response()->json([
                "Message" => "All Employee Qualification Data",
                "Data" => $employeeQualifications,
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
            $employeeQualification = DB::table('employee_qualifications as eq')
                ->select('eq.id', 'emp.first_name as employee ', 'qu.name as qualification')
                ->leftJoin('employees as emp', 'emp.id', '=', 'eq.employee')
                ->leftJoin('qualifications as qu', 'qu.id', '=', 'eq.qualification');

            $employeeQualification = $employeeQualification->orderBy('eq.created_at', 'desc')
                ->where('eq.id', $id)
                ->first();

            return response()->json([
                "Message" => "Employee Qualification Data",
                "Data" => $employeeQualification
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
}