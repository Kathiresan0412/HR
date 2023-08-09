<?php
namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function getAll(Request $request)
    {
        $promotions = DB::table('promotions as p')
            ->select('p.id', 'e.first_name as employee', 'p.previous_position', 'po.name as current_position', 'p.previous_salary', 'p.from', 'e.basic_salary as current_salary', 'p.status')
            ->leftJoin('employees as e', 'e.id', '=', 'p.employee')
            ->leftJoin('positions as po', 'po.id', '=', 'e.position');

        $search = $request->search;
        if (!is_null($search)) {
            $promotions = $promotions
                ->where('p.employee', 'LIKE', '%' . $search . '%')
                ->orWhere('p.previous_position', 'LIKE', '%' . $search . '%')
                ->orWhere('po.name', 'LIKE', '%' . $search . '%')
                ->orWhere('p.status', 'LIKE', '%' . $search . '%');
        }

        $filterParameters = [
            'status' => 'p.status',
            'previous_position' => 'p.previous_position',
            'current_position' => 'po.name',
            'from' => 'p.from'
        ];

        foreach ($filterParameters as $parameter => $column) {
            $value = $request->input($parameter);
            if (isset($value) && $value !== '') {
                $promotions->where($column, '=', $value);
            }
        }

        $promotions = $promotions->orderBy('p.created_at', 'desc')->get();

        return response()->json([
            "message" => "All Promotion Data",
            "data" => $promotions
        ], 200);
    }
    public function getOne($id)
    {
        try {
            $promotion = DB::table('promotions as p')
                ->select('p.id', 'e.first_name as employee', 'p.previous_position', 'po.name as current_position', 'p.previous_salary', 'p.from', 'e.basic_salary as current_salary', 'p.status')
                ->leftJoin('employees as e', 'e.id', '=', 'p.employee')
                ->leftJoin('positions as po', 'po.id', '=', 'e.position')
                ->where('p.id', $id)
                ->first();

            return response()->json([
                "message" => "Promotion Data",
                "data" => $promotion,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Oops somthing went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'previous_position' => 'required',
                'current_position' => 'required',
                'previous_salary' => 'required',
                'from' => 'required',
            ]);
            $promotion = new Promotion();
            $promotion->employee = $request->employee;
            $promotion->previous_position = $request->previous_position;
            $promotion->previous_salary = $request->previous_salary;
            $promotion->from = $request->from;
            $promotion->status = $request->status;
            $promotion->save();

            $id = $promotion->employee;
            $employee = Employee::find($id);
            $employee->position = $request->current_position;
            $employee->basic_salary = $request->current_salary;
            $employee->save();

            DB::commit();

            return response()->json([
                "message" => "Promotion Data Saved",
                "data" => $promotion,
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Oops somthing went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        //No Need
    }
    public function delete($id)
    {
        try {
            $promotion = Promotion::find($id);
            $promotion->delete();
            return response()->json([
                "message" => "Promotion Data Deleted"
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}