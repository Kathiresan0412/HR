<?php

namespace App\Http\Controllers;

use App\Models\SalarayAdvance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalarayAdvanceController extends Controller
{
    public function index(Request $request)
    {
        try {
            $salary_advances = DB::table('salaray_advances as sad')
                ->select('sad.id', 'emp.first_name as employee', 'sad.amount', 'sad.type', 'sad.from_date', 'sad.to_date', 'sad.description', 'sad.status')
                ->leftJoin('employees as emp', 'sad.employee', '=', 'emp.id');
            $search = $request->search;
            if (!is_null($search)) {
                $salary_advances = $salary_advances
                    ->where('sad.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('sad.type', 'LIKE', '%' . $search . '%');
            }
            $salary_advances = $salary_advances->orderBy('sad.id')->get();
            return response()->json([
                "message" => "salary_advances Data",
                "data" => $salary_advances,
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
            $salary_advances = DB::table('salaray_advances as sad')
                ->select('sad.id', 'emp.first_name as employee', 'sad.amount', 'sad.type', 'sad.from_date', 'sad.to_date', 'sad.description', 'sad.status')
                ->leftJoin('employees as emp', 'sad.employee', '=', 'emp.id')
                ->where('sad.id', $id)
                ->first();
            return response()->json([
                "message" => "salary_advances Data",
                "data" => $salary_advances,
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
                // ' bio_code' => 'required',
                // 'amount' => 'required',
                // 'type' => 'required',
                // 'from_date' => 'required',
                // 'to_date' => 'required',
                // 'description' => 'required'
            ]);
            $salary_advances = new SalarayAdvance();
            $salary_advances->employee = $request->employee;
            $salary_advances->amount = $request->amount;
            $salary_advances->type = $request->type;
            $salary_advances->from_date = $request->from_date;
            $salary_advances->to_date = $request->to_date;
            $salary_advances->status = $request->status;
            $salary_advances->description = $request->description;
            $salary_advances->save();
            DB::commit();
            return response()->json([
                "msg" => "salary_advances Data",
                "data" => $salary_advances,
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
                'amount' => 'required',
                'type' => 'required',
                'from_date' => 'required',
                'to_date' => 'required',
                'description' => 'required'
            ]);
            $salary_advances = SalarayAdvance::find($id);
            $salary_advances->employee = $request->employee;
            $salary_advances->amount = $request->amount;
            $salary_advances->type = $request->type;
            $salary_advances->from_date = $request->from_date;
            $salary_advances->to_date = $request->to_date;
            $salary_advances->description = $request->description;
            $salary_advances->save();
            DB::commit();
            return response()->json([
                "msg" => "salary_advances Data",
                "data" => $salary_advances,
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
            $salary_advances = SalarayAdvance::find($id);
            $salary_advances->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
