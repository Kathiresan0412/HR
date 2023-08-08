<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentsController extends Controller
{

    public function create()
    {
  
    }
    public function destroy($id)
    {
        try {
            $department = Departments::find($id);
            $department->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function index(Request $request,)
    {
        try {
            $department = DB::table('departments as d')
                ->select('d.id', 'd.name', 'd.description');
            $search = $request->search;
            if (!is_null($search)) {
                $department = $department
                    ->where('d.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('d.description', 'LIKE', '%' . $search . '%');
            }
            $department = $department->orderBy('d.id', 'desc')->get();

            return response()->json([
                "message" => "qualification Data",
                "data" => $department,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function edit($id)
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

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);
            $department = new Departments();
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();
            DB::commit();
            return response()->json([
                "msg" => "department Data",
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
            $department = Departments::find($id);
            $department->name = $request->name;
            $department->description = $request->description;
            $department->save();
            DB::commit();
            return response()->json([
                "msg" => "department Data",
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
}
