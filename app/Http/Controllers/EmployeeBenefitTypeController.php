<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeBenefitType;
use Illuminate\Http\Request;

class EmployeeBenefitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
      try{
        $EmployeeBenefitType = DB::table('employee_benefit_types as ebt')
        ->select('ebt.id','ebt.name','ebt.description');
   
        $search = $request->search;
        if (!is_null($search)){
            $EmployeeBenefitType = $EmployeeBenefitType
            ->where('ebt.name','LIKE','%'.$search.'%')
            ->orWhere('ebt.description','LIKE','%'.$search.'%');
        }
        $EmployeeBenefitType = $EmployeeBenefitType->orderBy('ebt.id','desc')->get();

        return response()->json([
            "message" => "EmployeeBenefitType Data",
            "data" => $EmployeeBenefitType,
        ],200);
    }catch(\Throwable $e){
        return response()->json([
            "message"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }  }

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
        try{
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);
  
        $EmployeeBenefitType = new EmployeeBenefitType();
        $EmployeeBenefitType->name = $request->name;
        $EmployeeBenefitType->description = $request->description;
        $EmployeeBenefitType->save();
  
        DB::commit();
  
        return response()->json([
            "msg" => "Employee Benefit Type Data",
            "data"=> $EmployeeBenefitType,
        ],201);
    }catch(\Throwable $e) {
        DB::rollback();
        return response()->json([
            "msg"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeBenefitType $employeeBenefitType)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        try{

            $EmployeeBenefitType = DB::table('employee_benefit_types as ebt')
            ->select('ebt.id','ebt.name','ebt.description')
            ->where('ebt.id',$id)
            ->first();
  
            return response()->json([
                "message" => "Employee Benefit Type Data",
                "data" => $EmployeeBenefitType,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        {
            DB::beginTransaction();
            try{
            $request->validate([
               'name'=>'required',
               'description'=>'required'
            ]);
      
            $EmployeeBenefitType = EmployeeBenefitType::find($id);
            $EmployeeBenefitType->name = $request->name;
            $EmployeeBenefitType->description = $request->description;
            $EmployeeBenefitType->save();  
         
          DB::commit();
      
          return response()->json([
            "msg" => "Employee Benefit Type Data",
            "data"=> $EmployeeBenefitType,
        ],201);
      }catch(\Throwable $e) {
        DB::rollback();
        return response()->json([
            "msg"=>"oops something went wrong",
            "error"=> $e->getMessage(),
        ],500);
    }
}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
            $EmployeeBenefitType = EmployeeBenefitType::find($id);
            $EmployeeBenefitType->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }
}
