<?php
namespace App\Http\Controllers;
use App\Models\Promotion;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{


    public function index(Request $request)
    {
        
        $promotions = DB::table('promotions as p')
            ->select('p.id', 'e.first_name as employee', 'p.previous_position', 'po.name as current_position', 'p.previous_salary', 'p.from', 'e.basic_salary as current_salary', 'p.status')
            ->leftJoin('employees as e', 'e.id', '=', 'p.employee')
            ->leftJoin('positions as po', 'po.id', '=', 'e.position');

            
            $filterParameters = [
                'status' => 'p.status',
                'previousPosition' => 'p.previousPosition',
                'from' => 'p.from',
                'previous_salary' => 'p.previous_salary',

            ];
    
            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $promotions->where($column, '=', $value);
                }
            }

        $search = $request->search;
        if (!is_null($search)) {
            $promotions = $promotions
                ->where('p.employee', 'LIKE', '%' . $search . '%')
                ->orWhere('p.previous_position', 'LIKE', '%' . $search . '%')
              //  ->orWhere('p.current_position', 'LIKE', '%' . $search . '%')
                ->orWhere('p.status', 'LIKE', '%' . $search . '%');
        }
        $promotions = $promotions->orderBy('p.created_at', 'desc')
            ->get();

        return response()->json([
            "message" => "All Promotions Data",
            "data" => $promotions,
        ], 200);
    }

    public function getOne($id)
    {
        try{
        $promotion = DB::table('promotions as b')
        ->select('b.id', 'e.first_name as employee', 'b.previous_position', 'p.name as position', 'b.previous_salary', 'b.from', 'e.basic_salary as current_salary', 'b.status')
        ->leftJoin('employees as e', 'e.id', '=', 'b.employee')
        ->leftJoin('positions as p', 'p.id', '=', 'e.position')
            ->where('b.id', $id)
            ->first();

        return response()->json([
            "message" => "Promotions Data",
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
                'previous_salary' => 'required',
                'from' => 'required',
            ]);
            $promotion = new Promotion();
            $promotion->employee = $request->employee; //RHS name form name and LHS name database 
            $promotion->previous_position = $request->previous_position;
            $promotion->previous_salary = $request->previous_salary;
            $promotion->from = $request->from;
            $promotion->status = $request->status;
            $promotion->save();

            $id=$promotion->employee;
            $employee = Employee::find($id);
            $employee->position = $request->current_position;
            $employee->basic_salary = $request->current_salary;
            $employee->save();
            
            DB::commit();

            return response()->json([
                "message" => "promotion Data Saved",
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
       
    }

    public function destroy($id)
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
