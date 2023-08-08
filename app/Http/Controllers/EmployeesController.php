<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use App\Models\EmployeeQualifications;

use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
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
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function destroy($id)
    {
        try {
            $employee = Employees::find($id);
            $employee->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**************************API functions**********************************/
    public function index(Request $request)
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
            $employees = $employees->orderBy('id', 'asc')
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

    public function edit($id)
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
                    'e.status'
                )
                ->leftJoin('companies as c', 'c.id', '=', 'e.company')
                ->leftJoin('positions as p', 'p.id', '=', 'e.position')
                ->leftJoin('departments as d', 'd.id', '=', 'e.department')
                ->leftJoin('users as u', 'u.id', '=', 'e.created_by')
                ->where('e.id', $id)
                ->first();
            $EmployeeQualification = EmployeeQualifications::leftJoin('qualifications as qu', 'qu.id', '=', 'employee_qualifications.qualification')
            ->where('employee', $id)
            ->get();
            $EmployeeQualifications = [];
            foreach ($EmployeeQualification as $employeeqalificatio) {
                // $qualific= $employeeqalificatio->qualification;
                // $qualific = DB::table('employee_qualifications as eq')
                // ->select('qu.name as qualification')
                // ->leftJoin('qualifications as qu', 'qu.id', '=', 'eq.qualification')
                // ->where('eq.id',$qualification)
                // ->first();
                return $employeeqalificatio;
                array_push($EmployeeQualifications, $employeeqalificatio->name);
                
            }

            return response()->json([
                "message" => "Selected employee Data",
                "data" => $employees,
                "EmployeeQualifications" => $EmployeeQualifications
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function store(Request $request)
    {
        //validate
        DB::beginTransaction();
        try {
            $employee = new Employees();
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
            $qualifications = $request->qualifications;
            foreach ($qualifications as $qualification) {
                $com = new EmployeeQualifications();
                $com->employee = $employee->id;
                $com->qualification = $qualification;
                $com->save();
            }
            DB::commit();
            return response()->json([
                "msg" => "Saved Employee Data",
                "data" => $employee,
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
        //validate
        DB::beginTransaction();
        try {

            $employee = Employees::find($id);
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

            EmployeeQualifications::where('employee', $id)->delete();

            $qualification = $request->qualification;
            if (!is_null($qualification)) {
                foreach ($qualification as $qualification) {
                    $com = new EmployeeQualifications();
                    $com->employee = $employee->id;
                    $com->qualification = $qualification;
                    $com->save();
                }
            }

            DB::commit();

            return response()->json([
                "msg" => "Updated Employee Data",
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

}