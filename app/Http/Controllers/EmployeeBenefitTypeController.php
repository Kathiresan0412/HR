<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\EmployeeBenefitType;
use Illuminate\Http\Request;

class EmployeeBenefitTypeController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $employeeBenefitTypes = DB::table('employee_benefit_types as ebt')
                ->select('ebt.id', 'ebt.name', 'ebt.description');

            $search = $request->search;
            if (!is_null($search)) {
                $employeeBenefitTypes = $employeeBenefitTypes
                    ->where('ebt.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('ebt.description', 'LIKE', '%' . $search . '%');
            }
            $employeeBenefitTypes = $employeeBenefitTypes->orderBy('ebt.created_at', 'desc')->get();

            return response()->json([
                "message" => "All Employee Benefit Type Data",
                "data" => $employeeBenefitTypes
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
            $employeeBenefitType = DB::table('employee_benefit_types as ebt')
                ->select('ebt.id', 'ebt.name', 'ebt.description')
                ->where('ebt.id', $id)
                ->first();

            return response()->json([
                "message" => "Employee Benefit Type Data",
                "data" => $employeeBenefitType
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

            $employeeBenefitType = new EmployeeBenefitType();
            $employeeBenefitType->name = $request->name;
            $employeeBenefitType->description = $request->description;
            $employeeBenefitType->save();

            DB::commit();

            return response()->json([
                "msg" => "Employee Benefit Type Data Saved",
                "data" => $employeeBenefitType
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
    { {
            DB::beginTransaction();
            try {
                $request->validate([
                    'name' => 'required',
                    'description' => 'required'
                ]);

                $employeeBenefitType = EmployeeBenefitType::find($id);
                $employeeBenefitType->name = $request->name;
                $employeeBenefitType->description = $request->description;
                $employeeBenefitType->save();

                DB::commit();

                return response()->json([
                    "msg" => "Employee Benefit Type Data Updated",
                    "data" => $employeeBenefitType
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
    public function delete($id)
    {
        try {
            $employeeBenefitType = EmployeeBenefitType::find($id);
            $employeeBenefitType->delete();
            return response()->json([
                "msg" => "Employee Benefit Type Data Deleted",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}