<?php

namespace App\Http\Controllers;

use App\Models\SalarayAdvance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalarayAdvanceController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $salaryAdvances = DB::table('salaray_advances as sad')
                ->select('sad.id', 'emp.first_name as employee', 'sad.amount', 'sad.type', 'sad.from_date', 'sad.to_date', 'sad.description', 'sad.status')
                ->leftJoin('employees as emp', 'sad.employee', '=', 'emp.id');
            $search = $request->search;
            if (!is_null($search)) {
                $salaryAdvances = $salaryAdvances
                    ->where('sad.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('sad.employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('sad.description', 'LIKE', '%' . $search . '%');
                //missing columns and Filter
            }

            $filterParameters = [
                'name' => 'p.name',
                'employee' => 'sad.employee',
                'description' => 'sad.description',

            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $salaryAdvances->where($column, '=', $value);
                }
            }

            $salaryAdvances = $salaryAdvances->orderBy('sad.created_at', 'desc')->get();
            return response()->json([
                "Message" => "All Salary Advances Data",
                "Data" => $salaryAdvances,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }

    public function getOne($id)
    {
        try {
            $salaryAdvance = DB::table('salaray_advances as sad')
                ->select('sad.id', 'emp.first_name as employee', 'sad.amount', 'sad.type', 'sad.from_date', 'sad.to_date', 'sad.description', 'sad.status')
                ->leftJoin('employees as emp', 'sad.employee', '=', 'emp.id');

            $salaryAdvance = $salaryAdvance->orderBy('sad.created_at', 'desc')
                ->where('sad.id', $id)
                ->first();

            return response()->json([
                "Message" => "Salary Advance Data",
                "Data" => $salaryAdvance,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
    public function save(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                ' bio_code' => 'required',
                'amount' => 'required',
                'type' => 'required',
                'from_date' => 'required',
                'to_date' => 'required',
                'description' => 'required'
            ]);
            $salaryAdvance = new SalarayAdvance();
            $salaryAdvance->employee = $request->employee;
            $salaryAdvance->amount = $request->amount;
            $salaryAdvance->type = $request->type;
            $salaryAdvance->from_date = $request->from_date;
            $salaryAdvance->to_date = $request->to_date;
            $salaryAdvance->status = $request->status;
            $salaryAdvance->description = $request->description;
            $salaryAdvance->save();

            DB::commit();

            return response()->json([
                "Message" => "Salary Advances Data Saved",
                "Data" => $salaryAdvance,
            ], 200);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
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

            $salaryAdvance = SalarayAdvance::find($id);
            $salaryAdvance->employee = $request->employee;
            $salaryAdvance->amount = $request->amount;
            $salaryAdvance->type = $request->type;
            $salaryAdvance->from_date = $request->from_date;
            $salaryAdvance->to_date = $request->to_date;
            $salaryAdvance->description = $request->description;
            $salaryAdvance->save();

            DB::commit();

            return response()->json([
                "Message" => "Salary Advances Data Updated",
                "Data" => $salaryAdvance,
            ], 200);
        } catch (\Throwable $e) {

            DB::rollback();

            return response()->json([
                "Message" => "oops something went wrong",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }


    public function delete($id)
    {
        try {
            $salaryAdvance = SalarayAdvance::find($id);
            $salaryAdvance->delete();
            return response()->json([
                "Message" => "Salary Advance Deleted",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "Message" => "Oops Something went wrong please try again",
                "Error" => $e->getMessage(),
            ], 500);
        }
    }
}
