<?php

namespace App\Http\Controllers;

use App\Models\RecruitmentCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecruitmentCandidateController extends Controller
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
    public function show(RecruitmentCandidate $recruitmentCandidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RecruitmentCandidate $recruitmentCandidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RecruitmentCandidate $recruitmentCandidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RecruitmentCandidate $recruitmentCandidate)
    {
        //
    }
    public function getAllRecruitmentCandidates(Request $request)
    {
        try {
            $recruit_candi = DB::table('recruitment_candidates as r')
           ->select('r.id','r.first_name','r.last_name','r.dob','r.gender','r.phone_no','r.e_mail','r.resume','r.application_date','p.id as position_id','interview_status')
           ->leftJoin('positions as p', 'p.id', '=', 'r.position_id');

           $search = $request->search;

           if (!is_null($search)){
               $recruit_candi = $recruit_candi
               ->where('r.id','LIKE','%'.$search.'%')
               ->orWhere('r.first_name','LIKE','%'.$search.'%')
               ->orWhere('r.last_name','LIKE','%'.$search.'%');
             
           }
          

           $recruit_candi = $recruit_candi->orderBy('r.id','desc')->get();

           return response()->json([
               "message" => "Recruitment candidates Data",
               "data" => $recruit_candi,
           ],200);
       }catch(\Throwable $e){
           return response()->json([
               "message"=>"oops something went wrong",
               "error"=> $e->getMessage(),
           ],500);
       }
    }

    
    public function getRecruitmentCandidateInfo($id)
    {
        try{

            $recruit_candi = DB::table('recruitment_candidates as r')
            ->select('r.id','r.first_name','r.last_name','r.dob','r.gender','r.phone_no','r.e_mail','r.resume','r.application_date','p.id as position_id','interview_status')
            ->leftJoin('positions as p', 'p.id', '=', 'r.position_id');

      
           $recruit_candi = $recruit_candi->orderBy('r.id','desc')
            ->where('r.id',$id)
            ->first();

            return response()->json([
                "message" => "Recruitment candidates Data",
                "data" => $recruit_candi,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    
    public function saveRecruitmentCandidates(Request $request)
    {
        DB::beginTransaction();

        try{
            $request->validate([
                'first_name'=>'required',
                'last_name'=>'required',
                'gender'=>'required',
            ]);
    
            $recruit_candi = new RecruitmentCandidate();
            $recruit_candi->first_name = $request->first_name;
            $recruit_candi->last_name = $request->last_name;
            $recruit_candi->dob = $request->dob;
            $recruit_candi->gender = $request->gender;
            $recruit_candi->phone_no = $request->phone_no;
            $recruit_candi->e_mail = $request->e_mail;
            $recruit_candi->resume = $request->resume;
            $recruit_candi->application_date = $request->application_date;
            $recruit_candi->position_id = $request->position_id;
            $recruit_candi->interview_status = $request->interview_status;
            $recruit_candi->save();
    
            DB::commit();
    
            return response()->json([
                "msg" => "Recruitment candidates Data",
                "data"=> $recruit_candi,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

   
    public function updateRecruitmentCandidates(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'first_name'=>'required',
                'last_name'=>'required',
                'gender'=>'required',
            ]);

            $recruit_candi = RecruitmentCandidate::find($id);
            $recruit_candi->first_name = $request->first_name;
            $recruit_candi->last_name = $request->last_name;
            $recruit_candi->dob = $request->dob;
            $recruit_candi->gender = $request->gender;
            $recruit_candi->phone_no = $request->phone_no;
            $recruit_candi->e_mail = $request->e_mail;
            $recruit_candi->resume = $request->resume;
            $recruit_candi->application_date = $request->application_date;
            $recruit_candi->position_id = $request->position_id;
            $recruit_candi->interview_status = $request->interview_status;
            $recruit_candi->save();
        
            DB::commit();

            return response()->json([
                "msg" => "Recruitment candidates Data",
                "data"=> $recruit_candi,
            ],201);
        }catch(\Throwable $e) {
            DB::rollback();
            return response()->json([
                "msg"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
        }

    public function destroyRecruitmentCandidates($id)
    {
        try{
                $recruit_candi = RecruitmentCandidate::find($id);
                $recruit_candi ->delete();

            }
            catch(\Throwable $e){
            return response()->json([
                "message"=>"Ooops Something went wrong please try again",
                "error"=> $e->getMessage(),
            ],500);
        }
    }
    
}
