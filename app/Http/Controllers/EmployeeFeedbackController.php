<?php

namespace App\Http\Controllers;

use App\Models\EmployeeFeedback;
use Illuminate\Http\Request;
use DB;

class EmployeeFeedbackController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $employeeFeedbacks = DB::table('employee_feedback as ef')
                ->select('ef.id', 'e.first_name as employee', 'ef.feedback_date', 'ef.feedback_comments', 'ef.survey_questions_and_responses')
                ->leftJoin('employees as e', 'e.id', '=', 'ef.employee');

            $search = $request->search;
            if (!is_null($search)) {
                $employeeFeedbacks = $employeeFeedbacks
                    ->where('ef.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('ef.employee', 'LIKE', '%' . $search . '%')
                    ->orWhere('ef.feedback_date', 'LIKE', '%' . $search . '%')
                    ->orWhere('ef.feedback_comments', 'LIKE', '%' . $search . '%')
                    ->orWhere('ef.survey_questions_and_responses', 'LIKE', '%' . $search . '%');
            }
            $filterParameters = [
                'employee' => 'ef.employee',
                'feedback_date' => 'ef.feedback_date',
            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $employeeFeedbacks->where($column, '=', $value);
                }
            }

            $employeeFeedbacks = $employeeFeedbacks->orderBy('ef.created_at', 'desc')->get();
            return response()->json([
                "message" => " All Employee Feedbacks Data",
                "data" => $employeeFeedbacks,
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
        try {
            $request->validate([
                'employee' => 'required',
                'feedback_date' => 'required',
                'feedback_comments' => 'required',
                'survey_questions_and_responses' => 'required'
            ]);

            $employeeFeedback = new EmployeeFeedback();
            $employeeFeedback->employee = $request->employee;
            $employeeFeedback->feedback_date = $request->feedback_date;
            $employeeFeedback->feedback_comments = $request->feedback_comments;
            $employeeFeedback->survey_questions_and_responses = $request->survey_questions_and_responses;
            $employeeFeedback->save();

            DB::commit();

            return response()->json([
                "msg" => "Employee Feedback Data Saved",
                "data" => $employeeFeedback,
            ], 200);

        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg" => "oops something went wrong",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
    public function getOne($id)
    {
        try {
            $employeeFeedback = DB::table('employee_feedback as ef')
                ->select('ef.id', 'e.first_name as employee', 'ef.feedback_date', 'ef.feedback_comments', 'ef.survey_questions_and_responses')
                ->leftJoin('employees as e', 'e.id', '=', 'ef.employee')
                ->where('ef.id', $id)
                ->first();

            return response()->json([
                "message" => "Employee Feedback Data",
                "data" => $employeeFeedback,
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
                'employee' => 'required',
                'feedback_date' => 'required',
                'feedback_comments' => 'required',
                'survey_questions_and_responses' => 'required'
            ]);

            $employeeFeedback = EmployeeFeedback::find($id);
            $employeeFeedback->employee = $request->employee;
            $employeeFeedback->feedback_date = $request->feedback_date;
            $employeeFeedback->feedback_comments = $request->feedback_comments;
            $employeeFeedback->survey_questions_and_responses = $request->survey_questions_and_responses;
            $employeeFeedback->save();

            DB::commit();

            return response()->json([
                "msg" => "Employee Feedback Data Updated",
                "data" => $employeeFeedback,
            ], 200);

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
            $employeeFeedback = EmployeeFeedback::find($id);
            $employeeFeedback->delete();

            return response()->json([
                "message" => "Employee Feedback Data Deleted"
            ], 200);

        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}