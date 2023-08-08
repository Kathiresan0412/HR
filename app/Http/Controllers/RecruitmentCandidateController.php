<?php

namespace App\Http\Controllers;

use App\Models\RecruitmentCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecruitmentCandidateController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $recruitCandidates = DB::table('recruitment_candidates as r')
                ->select('r.id', 'r.first_name', 'r.last_name', 'r.dob', 'r.gender', 'r.phone_no', 'r.e_mail', 'r.resume', 'r.application_date', 'p.id as position_id', 'interview_status')
                ->leftJoin('positions as p', 'p.id', '=', 'r.position_id');

            $search = $request->search;

            if (!is_null($search)) {
                $recruitCandidates = $recruitCandidates
                    ->where('r.id', 'LIKE', '%' . $search . '%')
                    ->orWhere('r.first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('r.last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('r.phone_no', 'LIKE', '%' . $search . '%')
                    ->orWhere('r.e_mail', 'LIKE', '%' . $search . '%')
                    ->orWhere('r.position_id', 'LIKE', '%' . $search . '%')
                    ->orWhere('r.application_date', 'LIKE', '%' . $search . '%');
            }

            $filterParameters = [
                'dob' => 'r.dob',
                'gender' => 'r.gender',
                'application_date' => 'r.application_date',
                'interview_status' => 'r.interview_status'
            ];

            foreach ($filterParameters as $parameter => $column) {
                $value = $request->input($parameter);
                if (isset($value) && $value !== '') {
                    $recruitCandidates->where($column, '=', $value);
                }
            }

            $recruitCandidates = $recruitCandidates->orderBy('r.created_at', 'desc')->get();

            return response()->json([
                "message" => "All Recruitment candidate Data",
                "data" => $recruitCandidates
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function getOne($id)
    {
        try {
            $recruitCandidate = DB::table('recruitment_candidates as r')
                ->select('r.id', 'r.first_name', 'r.last_name', 'r.dob', 'r.gender', 'r.phone_no', 'r.e_mail', 'r.resume', 'r.application_date', 'p.id as position_id', 'interview_status')
                ->leftJoin('positions as p', 'p.id', '=', 'r.position_id')
                ->where('r.id', $id)
                ->first();

            return response()->json([
                "message" => "Recruitment candidate Data",
                "data" => $recruitCandidate
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "oops something went wrong",
                "error" => $e->getMessage()
            ], 500);
        }
    }
    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'interview_status' => 'required',
                'phone_no' => 'required',
                'e_mail' => 'required'
            ]);

            $recruitCandidate = new RecruitmentCandidate();
            $recruitCandidate->first_name = $request->first_name;
            $recruitCandidate->last_name = $request->last_name;
            $recruitCandidate->dob = $request->dob;
            $recruitCandidate->gender = $request->gender;
            $recruitCandidate->phone_no = $request->phone_no;
            $recruitCandidate->e_mail = $request->e_mail;
            $recruitCandidate->resume = $request->resume;
            $recruitCandidate->application_date = $request->application_date;
            $recruitCandidate->position_id = $request->position_id;
            $recruitCandidate->interview_status = $request->interview_status;
            $recruitCandidate->save();

            DB::commit();

            return response()->json([
                "msg" => "Recruitment candidate Data Saved",
                "data" => $recruitCandidate
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
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'interview_status' => 'required',
                'phone_no' => 'required',
                'e_mail' => 'required'
            ]);

            $recruitCandidate = RecruitmentCandidate::find($id);
            $recruitCandidate->first_name = $request->first_name;
            $recruitCandidate->last_name = $request->last_name;
            $recruitCandidate->dob = $request->dob;
            $recruitCandidate->gender = $request->gender;
            $recruitCandidate->phone_no = $request->phone_no;
            $recruitCandidate->e_mail = $request->e_mail;
            $recruitCandidate->resume = $request->resume;
            $recruitCandidate->application_date = $request->application_date;
            $recruitCandidate->position_id = $request->position_id;
            $recruitCandidate->interview_status = $request->interview_status;
            $recruitCandidate->save();

            DB::commit();

            return response()->json([
                "msg" => "Recruitment candidate Data Updated",
                "data" => $recruitCandidate,
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
            $recruitCandidate = RecruitmentCandidate::find($id);
            $recruitCandidate->delete();

            return response()->json([
                "msg" => "Recruitment Candidate Data Deleted"
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}