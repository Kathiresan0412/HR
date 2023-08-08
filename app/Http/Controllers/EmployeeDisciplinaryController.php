<?php

namespace App\Http\Controllers;

use App\Models\EmployeeDisciplinary;
use Illuminate\Http\Request;
use DB;


class EmployeeDisciplinaryController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $empDisciplines = DB::table('employee_disciplinaries as e')
                ->select('e.id', 'em.id as employee', 'e.incident_date', 'e.description', 'e.follow_up_notes')
                ->leftJoin('employees as em', 'em.id', '=', 'e.employee');

            $search = $request->search;

            if (!is_null($search)) {
                $empDisciplines = $empDisciplines
                    ->where('e.incident_date', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.description', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.follow_up_notes', 'LIKE', '%' . $search . '%')
                    ->orWhere('e.employee', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'incident_date' => 'e.incident_date'
            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $empDisciplines->where($column, '=', $value);
                }
            }

            $empDisciplines = $empDisciplines->orderBy('e.created_at', 'desc')->get();

            return response()->json([
                "message" => "All Employee Disciplinary Data",
                "data" => $empDisciplines,
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
            $empDiscipline = DB::table('employee_disciplinaries as e')
                ->select('e.id', 'em.id as employee', 'e.incident_date', 'e.description', 'e.follow_up_notes')
                ->leftJoin('employees as em', 'em.id', '=', 'e.employee')
                ->where('e.id', $id)
                ->first();

            return response()->json([
                "message" => "Employee Disciplinary Data",
                "data" => $empDiscipline,
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
                'incident_date' => 'required',
                'description' => 'required',
                'follow_up_notes' => 'required',
                'employee' => 'required'
            ]);

            $empDiscipline = new EmployeeDisciplinary();
            $empDiscipline->employee = $request->employee;
            $empDiscipline->incident_date = $request->incident_date;
            $empDiscipline->description = $request->description;
            $empDiscipline->follow_up_notes = $request->follow_up_notes;
            $empDiscipline->save();

            DB::commit();

            return response()->json([
                "message" => "Employee Disciplinary Data Saved",
                "data" => $empDiscipline
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function update(EmployeeDisciplinary $employeeDisciplinary, Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'incident_date' => 'required',
                'description' => 'required',
                'follow_up_notes' => 'required',
                'employee' => 'required'
            ]);

            $empDiscipline = EmployeeDisciplinary::find($id);
            $empDiscipline->employee = $request->employee;
            $empDiscipline->incident_date = $request->incident_date;
            $empDiscipline->description = $request->description;
            $empDiscipline->follow_up_notes = $request->follow_up_notes;
            $empDiscipline->save();

            DB::commit();

            return response()->json([
                "message" => "Employee Disciplinary Data Updated",
                "data" => $empDiscipline,
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
            $empDiscipline = EmployeeDisciplinary::find($id);
            $empDiscipline->delete();

            return response()->json([
                "msg" => "Employee Disciplinary Data Deleted"
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}