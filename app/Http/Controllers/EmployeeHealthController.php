<?php

namespace App\Http\Controllers;

use App\Models\EmployeeHealth;
use Illuminate\Http\Request;
use DB;

class EmployeeHealthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $employee_healths = DB::table('employee_healths as eh')
                ->select('eh.id', 'e.first_name as employee', 'eh.medical_examination_date', 'eh.medical_condition', 'eh.Doctor_notes', 'eh.allergies', 'eh.prescription_details')
                ->leftJoin('employees as e', 'e.id', '=', 'eh.employee');


            $search = $request->search;
            if (!is_null($search)) {
                $employee_healths = $employee_healths
                    ->where('eh.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.medical_examination_date', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.medical_condition', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.Doctor_notes', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.allergies', 'LIKE', '%' . $search . '%')
                    ->orWhere('eh.prescription_details', 'LIKE', '%' . $search . '%');
            }
            $employee_healths = $employee_healths->orderBy('eh.id', 'asc')->get();
            return response()->json([
                "message" => "employee_healths Data",
                "data" => $employee_healths,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

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
    public function store(Request $request)
    {
        try {
            $request->validate([
                'employee' => 'required',
                'medical_examination_date' => 'required',
                'medical_condition' => 'required',
                'Doctor_notes' => 'required',
                'allergies' => 'required',
                'prescription_details' => 'required']);
          

            $employee_healths = new EmployeeHealth();
            $employee_healths->employee = $request->employee;
            $employee_healths->medical_examination_date = $request->medical_examination_date;
            $employee_healths->medical_condition = $request->medical_condition;
            $employee_healths->Doctor_notes = $request->Doctor_notes;
            $employee_healths->allergies = $request->allergies;
            $employee_healths->prescription_details = $request->prescription_details;
            $employee_healths->save();

            DB::commit();

            return response()->json([
                "msg" => "employee_healths Data",
                "data" => $employee_healths,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeHealth $employeeHealth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $employee_healths = DB::table('employee_healths as eh')
            ->select('eh.id', 'e.first_name as employee', 'eh.medical_examination_date', 'eh.medical_condition', 'eh.Doctor_notes', 'eh.allergies', 'eh.prescription_details')
            ->leftJoin('employees as e', 'e.id', '=', 'eh.employee')
            ->where('eh.id', $id)
            ->first();

            return response()->json([
                "message" => "employee_healths Data",
                "data" => $employee_healths,
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
            $employee_healths = EmployeeHealth::find($id);
            $employee_healths->employee = $request->employee;
            $employee_healths->medical_examination_date = $request->medical_examination_date;
            $employee_healths->medical_condition = $request->medical_condition;
            $employee_healths->Doctor_notes = $request->Doctor_notes;
            $employee_healths->allergies = $request->allergies;
            $employee_healths->prescription_details = $request->prescription_details;
            $employee_healths->save();

            DB::commit();
            return response()->json([
                "msg" => "employee_healths Data",
                "data" => $employee_healths,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $employee_healths = EmployeeHealth::find($id);
            $employee_healths->delete();

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
