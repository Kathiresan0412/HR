<?php

namespace App\Http\Controllers;

use App\Models\Promotions;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotions $promotions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotions $promotions)
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotions $promotions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotions $promotions)
    {
        //
    }
    public function getAllPromotions(Request $request)
    {
        //  try {
        $promotions = DB::table('promotions as b')
            ->select('b.id', 'e.first_name as employee', 'b.previous_position', 'p.name as position', 'b.previous_salary', 'b.from', 'e.basic_salary as current_salary', 'b.status')
            ->leftJoin('employees as e', 'e.id', '=', 'b.employee')
            ->leftJoin('positions as p', 'p.id', '=', 'e.position');

        $search = $request->search;

        if (!is_null($search)) {
            $promotions = $promotions
                ->where('b.employee', 'LIKE', '%' . $search . '%')
                ->orWhere('b.previous_position', 'LIKE', '%' . $search . '%')
                ->orWhere('b.position', 'LIKE', '%' . $search . '%')
                ->orWhere('b.status', 'LIKE', '%' . $search . '%');
        }
        $promotions = $promotions->orderBy('id', 'asc')
            ->get();

        return response()->json([
            "message" => "positions Data",
            "data" => $promotions,
        ], 200);
    }

    public function getPromotionInfo($id)
    {
        $promotions = DB::table('promotions as b')
        ->select('b.id', 'e.first_name as employee', 'b.previous_position', 'p.name as position', 'b.previous_salary', 'b.from', 'e.basic_salary as current_salary', 'b.status')
        ->leftJoin('employees as e', 'e.id', '=', 'b.employee')
        ->leftJoin('positions as p', 'p.id', '=', 'e.position')
            ->where('b.id', $id)
            ->first();

        return response()->json([
            "message" => "promotions Data",
            "data" => $promotions,
        ], 200);
        //  } catch (\Throwable $e) {
        //      return response()->json([
        //          "message" => "Oops somthing went wrong please try again",
        //          "error" => $e->getMessage(),
        //      ], 500);
        //  }

    }

    public function savePromotion(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'previous_position' => 'required',
                'position' => 'required',
                'previous_salary' => 'required',
                'from' => 'required',
               // 'current_salary' => 'required',
                'status' => 'required'
            ]);

            $promotion = new Promotions();
            $promotion->employee = $request->employee; //RHS name form name and LHS name database 
            $promotion->previous_position = $request->previous_position;
            $promotion->position = $request->position;
            $promotion->previous_salary = $request->previous_salary;
            $promotion->from = $request->from;
            $promotion->current_salary = $request->current_salary;
            $promotion->status = $request->status;
            $promotion->save();

            $id=$promotion->employee;
            $employee = Employees::find($id);
            $employee->position = $request->position;
            $employee->basic_salary = $request->basic_salary;
            $employee->save();
            
            DB::commit();

            return response()->json([
                "message" => "promotion Data",
                "data" => $promotion,
            ], 201);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Oops somthing went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public function updatePromotion(Request $request, $id)
    {
       
    }

    public function destroyPromotion($id)
    {
        try {
            $promotions = Promotions::find($id);
            $promotions->delete();

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
