<?php

namespace App\Http\Controllers;

use App\Models\SalaryType;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SalaryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $salary = DB::table('salary_types as s')
                ->select('s.id', 's.title', 's.category', 's.description');

            $search = $request->search;
            if (!is_null($search)) {
                $salary = $salary
                    ->where('s.title', 'LIKE', '%' . $search . '%')
                    ->orWhere('s.category', 'LIKE', '%' . $search . '%')
                    ->orWhere('s.description', 'LIKE', '%' . $search . '%');
            }
            $salary = $salary->orderBy('s.id', 'desc')->get();

            return response()->json([
                "message" => "position Data",
                "data" => $salary,
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
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => 'required',
                'category' => 'required',
                'description' => 'required'
            ]);
            $salary = new SalaryType();
            $salary->title = $request->title;
            $salary->category = $request->category;
            $salary->description = $request->description;
            $salary->save();
            DB::commit();
            return response()->json([
                "msg" => "Position Data",
                "data" => $salary,
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
    public function show(SalaryType $salaryType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $salary = DB::table('salary_types as s')
                ->select('s.id', 's.title', 's.category', 's.description')
                ->where('s.id', $id)
                ->first();

            return response()->json([
                "message" => "Position Data",
                "data" => $salary,
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
                'title' => 'required',
                'category' => 'required',
                'description' => 'required'
            ]);
            $salary = SalaryType::find($id);
            $salary->title = $request->title;
            $salary->category = $request->category;
            $salary->description = $request->description;
            $salary->save();
            DB::commit();
            return response()->json([
                "msg" => "Position Data",
                "data" => $salary,
            ], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $salary = SalaryType::find($id);
            $salary->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
