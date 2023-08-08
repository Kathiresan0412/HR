<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $departments = DB::table('departments as d')
                ->select('d.id', 'd.name', 'd.description');

                $filterParameters = [
                    'name' => 'd.name', 
                ];

                foreach ($filterParameters as $parameter => $column) {
                    $value = $request->input($parameter);
                    if (isset($value) && $value !== '') {
                        $departments->where($column, '=', $value);
                    }
                }
            $search = $request->search;

            if (!is_null($search)) {
                $departments = $departments
                    ->where('d.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('d.description', 'LIKE', '%' . $search . '%');
            }
            $departments = $departments->orderBy('d.created_at', 'desc')->get();

            return response()->json([
                "message" => "All Departments Data",
                "data" => $departments,
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
            $department = DB::table('departments as d')
                ->select('d.id', 'd.name', 'd.description')
                ->where('d.id', $id)
                ->first();

            return response()->json([
                "message" => "department Data",
                "data" => $department,
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
                'name' => 'required',
                'description' => 'required'
            ]);

            $department = new Department();
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();

            DB::commit();

            return response()->json([
                "msg" => "department Data saved",
                "data" => $department,
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
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);

            $department = Department::find($id);
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();

            DB::commit();
            
            return response()->json([
                "msg" => "department Data Updated",
                "data" => $department,
            ], 201);
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
            $department = Department::find($id);
            $department->delete();
            return response()->json([
                "message" => "Department  record deleted successfully",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}