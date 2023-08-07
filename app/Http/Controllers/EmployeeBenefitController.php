<?php

namespace App\Http\Controllers;

use App\Models\EmployeeBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EmployeeBenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $eemployeeBenefits = DB::table('employee_benefits as eb')
        ->select('eb.id','e.first_name as employee','ebt.name as benefit_type','eb.coverage_details','eb.premiums','eb.beneficiary_information')
        ->leftJoin('employees as e', 'e.id', '=', 'eb.employee')
        ->leftJoin('employee_benefit_types as ebt', 'ebt.id', '=','eb.benefit_type');
        

           $search = $request->search;
           if (!is_null($search)){
               $eemployeeBenefits = $eemployeeBenefits
               ->where('eb.id','LIKE','%'.$search.'%')
               ->orWhere('eb.employee','LIKE','%'.$search.'%')
               ->orWhere('eb.benefit_type','LIKE','%'.$search.'%')
               ->orWhere('eb.coverage_details','LIKE','%'.$search.'%')
               ->orWhere('eb.premiums','LIKE','%'.$search.'%')
               ->orWhere('eb.beneficiary_information','LIKE','%'.$search.'%');

           }
           $eemployeeBenefits = $eemployeeBenefits->orderBy('eb.id','desc')->get();

           return response()->json([
               "message" => "Employee benefits Data",
               "data" => $eemployeeBenefits,
           ],200);
       }catch(\Throwable $e){
           return response()->json([
               "message"=>"oops something went wrong",
               "error"=> $e->getMessage(),
           ],500);
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
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
               // 'benefit_type' => 'required',
                'coverage_details' => 'required',
                'premiums' => 'required',
                'beneficiary_information' => 'required'
            ]);

            $eemployeeBenefits = new EmployeeBenefit();
            $eemployeeBenefits->employee = $request->employee;
            $eemployeeBenefits->benefit_type = $request->benefit_type;
            $eemployeeBenefits->coverage_details = $request->coverage_details;
            $eemployeeBenefits->premiums = $request->premiums;
            $eemployeeBenefits->beneficiary_information = $request->beneficiary_information;
            $eemployeeBenefits->save();

            DB::commit();

            return response()->json([
                "msg" => "Employee benefits Data",
                "data" => $eemployeeBenefits,
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
    public function show(EmployeeBenefit $employeeBenefit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        try {

            $eemployeeBenefits = DB::table('employee_benefits as eb')
            ->select('eb.id','e.first_name as employee','ebt.name as benefit_type','eb.coverage_details','eb.premiums','eb.beneficiary_information')
            ->leftJoin('employees as e', 'e.id', '=', 'eb.employee')
            ->leftJoin('employee_benefit_types as ebt', 'ebt.id', '=','eb.benefit_type')
                ->where('eb.id', $id)
                ->first();

            return response()->json([
                "message" => "Employee benefits Data",
                "data" => $eemployeeBenefits,
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
    public function update(Request $request,  $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'employee' => 'required',
                //'benefit_type' => 'required',
                'coverage_details' => 'required',
                'premiums' => 'required',
                'beneficiary_information' => 'required'
            ]);

            $EmployeeBenefit =EmployeeBenefit ::find($id);
            $EmployeeBenefit->employee = $request->employee;
            $EmployeeBenefit->benefit_type = $request->benefit_type;
            $EmployeeBenefit->coverage_details = $request->coverage_details;
            $EmployeeBenefit->premiums = $request->premiums;
            $EmployeeBenefit->to_date = $request->to_date;
            $EmployeeBenefit->beneficiary_information = $request->beneficiary_information;
            $EmployeeBenefit->save();

            DB::commit();

            return response()->json([
                "msg" => "Employee benefits Data",
                "data" => $EmployeeBenefit,
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
    public function destroy( $id)
    {
        {
            try {
                $EEmployeeBenefit = EmployeeBenefit::find($id);
                $EEmployeeBenefit->delete();
            } catch (\Throwable $e) {
                return response()->json([
                    "message" => "Ooops Something went wrong please try again",
                    "error" => $e->getMessage(),
                ], 500);
            }
        }
    }
}
