<?php

namespace App\Http\Controllers;

use App\Models\EmployeeFeedback;
use Illuminate\Http\Request;
use DB;

class EmployeeFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $employee_feedback = DB::table('employee_feedback as ef')
                ->select('ef.id', 'e.name as employee', 'ef.feedback_date', 'ef.feedback_comments', 'ef.survey_questions_and_responses')
                ->leftJoin('employees as e', 'e.id', '=', 'ef.employee');


            $search = $request->search;
            if (!is_null($search)) {
                $employee_feedback = $employee_feedback
                    ->where('ef.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('ef.employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('ef.feedback_date', 'LIKE', '%' . $search . '%')
                    ->orWhere('ef.feedback_comments', 'LIKE', '%' . $search . '%')
                    ->orWhere('ef.survey_questions_and_responses', 'LIKE', '%' . $search . '%');
            }
            $employee_feedback = $employee_feedback->orderBy('ef.id', 'asc')->get();
            return response()->json([
                "message" => "employee_feedback Data",
                "data" => $employee_feedback,
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
        try {
            $request->validate([
                'employee' => 'required',
                'feedback_date' => 'required',
                'feedback_comments' => 'required',
                'survey_questions_and_responses' => 'required'
            ]);

            $employee_feedback = new EmployeeFeedback();
            $employee_feedback->employee = $request->employee;
            $employee_feedback->feedback_date = $request->feedback_date;
            $employee_feedback->feedback_comments = $request->feedback_comments;
            $employee_feedback->survey_questions_and_responses = $request->survey_questions_and_responses;
            $employee_feedback->save();

            DB::commit();

            return response()->json([
                "msg" => "employee_feedback Data",
                "data" => $employee_feedback,
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
    public function show(EmployeeFeedback $employeeFeedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $employee_feedback = DB::table('employee_feedback as ef')
                ->select('ef.id', 'e.name as employee', 'ef.feedback_date', 'ef.feedback_comments', 'ef.survey_questions_and_responses')
                ->leftJoin('employees as e', 'e.id', '=', 'ef.employee')
                ->where('ef.id', $id)
                ->first();

            return response()->json([
                "message" => "employee_feedback Data",
                "data" => $employee_feedback,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                'feedback_date' => 'required',
                'feedback_comments' => 'required',
                'survey_questions_and_responses' => 'required'
            ]);
            $employee_feedback = EmployeeFeedback::find($id);
            $employee_feedback->employee = $request->employee;
            $employee_feedback->feedback_date = $request->feedback_date;
            $employee_feedback->feedback_comments = $request->feedback_comments;
            $employee_feedback->survey_questions_and_responses = $request->survey_questions_and_responses;
            $employee_feedback->save();

            DB::commit();
            return response()->json([
                "msg" => "employee_feedback Data",
                "data" => $employee_feedback,
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $employee_feedback = EmployeeFeedback::find($id);
            $employee_feedback->delete();

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}