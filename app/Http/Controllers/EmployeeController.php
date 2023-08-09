<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\EmployeeQualification;

use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $employees = DB::table('employees as e')
                ->select(
                    'e.id',
                    'e.bio_code',
                    'e.first_name',
                    'e.last_name',
                    'e.dob_date',
                    'e.gender',
                    'e.mobile',
                    'e.alternative_phone',
                    'e.landline_number',
                    'e.emergency_mobile',
                    'e.email',
                    'e.address',
                    'e.blood',
                    'e.nic',
                    'e.passport_no',
                    'c.name as company',
                    'p.name as position',
                    'd.name as department',
                    'e.basic_salary',
                    'e.budgetary_relief',
                    'e.hire_date',
                    'e.has_shift',
                    'e.ot_eligibility',
                    'e.reg_hiredate',
                    'e.locker_number',
                    'u.name as created_by',
                    'e.img',
                    'e.status',
                )
                ->leftJoin('companies as c', 'c.id', '=', 'e.company')
                ->leftJoin('positions as p', 'p.id', '=', 'e.position')
                ->leftJoin('departments as d', 'd.id', '=', 'e.department')
                ->leftJoin('users as u', 'u.id', '=', 'e.created_by');


            $search = $request->search;

            if (!is_null($search)) {
                $employees = $employees
                    ->where('e.bio_code', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.mobile', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.email', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.address', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.nic', 'LIKE', '%' . $search . '%');
            }
            //filter----------------------------------------------
            $filterParameters = [
                'type' => 'p.type',
                'dob_date' => 'e.dob_date',
                'gender' => 'e.gender',
                'blood' => 'e.blood',
                'company' => 'e.company',
                'position' => 'e.position',
                'department' => 'e.department',
                'hire_date' => 'e.hire_date',
                'reg_hiredate' => 'e.reg_hiredate'

            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $employees->where($column, '=', $value);
                }
            }
            //filter----------------------------------------------

            $employees = $employees->orderBy('e.created_at', 'desc')
                ->get();

            return response()->json([
                "message" => "All employees Data",
                "data" => $employees,
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Oops somthing went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }

    }

    public function getOne($id)
    {
        try {
            $employee = DB::table('employees as e')
                ->select(
                    'e.id',
                    'e.bio_code',
                    'e.first_name',
                    'e.last_name',
                    'e.dob_date',
                    'e.gender',
                    'e.mobile',
                    'e.alternative_phone',
                    'e.landline_number',
                    'e.emergency_mobile',
                    'e.email',
                    'e.address',
                    'e.blood',
                    'e.nic',
                    'e.passport_no',
                    'c.name as company',
                    'p.name as position',
                    'd.name as department',
                    'e.basic_salary',
                    'e.budgetary_relief',
                    'e.hire_date',
                    'e.has_shift',
                    'e.ot_eligibility',
                    'e.reg_hiredate',
                    'e.locker_number',
                    'u.name as created_by',
                    'e.img',
                    'e.status'
                )
                ->leftJoin('companies as c', 'c.id', '=', 'e.company')
                ->leftJoin('positions as p', 'p.id', '=', 'e.position')
                ->leftJoin('departments as d', 'd.id', '=', 'e.department')
                ->leftJoin('users as u', 'u.id', '=', 'e.created_by')
                ->where('e.id', $id)
                ->first();
            $employeeQualification = EmployeeQualification::leftJoin('qualifications as qu', 'qu.id', '=', 'employee_qualifications.qualification')
                ->where('employee', $id)
                ->get();
            $employeeQualifications = [];
            foreach ($employeeQualification as $employeeqalificatio) {
                array_push($employeeQualifications, $employeeqalificatio->name);

            }

            return response()->json([
                "message" => "Employee Data",
                "data" => $employee,
                "EmployeeQualifications" => $employeeQualifications
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
                'bio_code' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'dob_date' => 'required',
                'gender' => 'required',
                'mobile' => 'required',
                'alternative_phone' => 'required',
                'landline_number' => 'required',
                'emergency_mobile' => 'required',
                'email' => 'required',
                'address' => 'required',
                'blood' => 'required',
                'nic' => 'required',
                'passport_no' => 'required',
                'company' => 'required',
                'position' => 'required',
                'department' => 'required',
                'basic_salary' => 'required',
                'budgetary_relief' => 'required',
                'hire_date' => 'required',
                'has_shift' => 'required',
                'ot_eligibility' => 'required',
                'reg_hiredate' => 'required',
                'locker_number' => 'required',
                'created_by' => 'required',
                'img' => 'required',
                'status' => 'required',
                'qualifications' => 'array',
                'qualification' => 'required'
            ]);

            $employee = new Employee();
            $employee->bio_code = $request->input('bio_code');
            $employee->first_name = $request->input('first_name');
            $employee->last_name = $request->input('last_name');
            $employee->dob_date = $request->input('dob_date');
            $employee->gender = $request->input('gender');
            $employee->mobile = $request->input('mobile');
            $employee->alternative_phone = $request->input('alternative_phone');
            $employee->landline_number = $request->input('landline_number');
            $employee->emergency_mobile = $request->input('emergency_mobile');
            $employee->email = $request->input('email');
            $employee->address = $request->input('address');
            $employee->blood = $request->input('blood');
            $employee->nic = $request->input('nic');
            $employee->passport_no = $request->input('passport_no');
            $employee->company = $request->input('company');
            $employee->position = $request->input('position');
            $employee->department = $request->input('department');
            $employee->basic_salary = $request->input('basic_salary');
            $employee->budgetary_relief = $request->input('budgetary_relief');
            $employee->hire_date = $request->input('hire_date');
            $employee->has_shift = $request->input('has_shift');
            $employee->ot_eligibility = $request->input('ot_eligibility');
            $employee->reg_hiredate = $request->input('reg_hiredate');
            $employee->locker_number = $request->input('locker_number');
            $employee->created_by = $request->input('created_by');
            $employee->img = $request->input('img');
            $employee->status = $request->input('status');
            $employee->save();

            $employee_id = $employee->id;

            $qualifications = $request->qualification;
            foreach($qualifications as $qualification){
                $employeeQualification=new EmployeeQualification();
                $employeeQualification->employee = $employee_id;
                $employeeQualification->qualification = $qualification;
                $employeeQualification->save();
            }

            DB::commit();
            return response()->json([
                "msg" => "Employee Data Saved",
                "data" => $employee,
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
                'bio_code' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'dob_date' => 'required',
                'gender' => 'required',
                'mobile' => 'required',
                'alternative_phone' => 'required',
                'landline_number' => 'required',
                'emergency_mobile' => 'required',
                'email' => 'required',
                'address' => 'required',
                'blood' => 'required',
                'nic' => 'required',
                'passport_no' => 'required',
                'company' => 'required',
                'position' => 'required',
                'department' => 'required',
                'basic_salary' => 'required',
                'budgetary_relief' => 'required',
                'hire_date' => 'required',
                'has_shift' => 'required',
                'ot_eligibility' => 'required',
                'reg_hiredate' => 'required',
                'locker_number' => 'required',
                'created_by' => 'required',
                'img' => 'required',
                'status' => 'required',
                'qualification' => 'required'
            ]);

            $employee = Employee::find($id);
            $employee->bio_code = $request->input('bio_code');
            $employee->first_name = $request->input('first_name');
            $employee->last_name = $request->input('last_name');
            $employee->dob_date = $request->input('dob_date');
            $employee->gender = $request->input('gender');
            $employee->mobile = $request->input('mobile');
            $employee->alternative_phone = $request->input('alternative_phone');
            $employee->landline_number = $request->input('landline_number');
            $employee->emergency_mobile = $request->input('emergency_mobile');
            $employee->email = $request->input('email');
            $employee->address = $request->input('address');
            $employee->blood = $request->input('blood');
            $employee->nic = $request->input('nic');
            $employee->passport_no = $request->input('passport_no');
            $employee->company = $request->input('company');
            $employee->position = $request->input('position');
            $employee->department = $request->input('department');
            $employee->basic_salary = $request->input('basic_salary');
            $employee->budgetary_relief = $request->input('budgetary_relief');
            $employee->hire_date = $request->input('hire_date');
            $employee->has_shift = $request->input('has_shift');
            $employee->ot_eligibility = $request->input('ot_eligibility');
            $employee->reg_hiredate = $request->input('reg_hiredate');
            $employee->locker_number = $request->input('locker_number');
            $employee->created_by = $request->input('created_by');
            $employee->img = $request->input('img');
            $employee->status = $request->input('status');
            $employee->save();

            EmployeeQualification::where('employee', $id)->delete();

            $qualification = $request->qualification;
            if (!is_null($qualification)) {
                foreach ($qualification as $qualification) {
                    $employeeQualification = new EmployeeQualification();
                    $employeeQualification->employee = $employee->id;
                    $employeeQualification->qualification = $qualification;
                    $employeeQualification->save();
                }
            }

            DB::commit();

            return response()->json([
                "msg" => "Employee Data Updated",
                "data" => $employee,
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
            $employee = Employee::find($id);
            $employee->delete();

            return response()->json([
                "message" => "Employee Data Deleted"
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

}