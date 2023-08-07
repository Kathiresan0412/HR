<?php

namespace App\Http\Controllers;

use App\Models\EmployeeEmergencyContact;
use Illuminate\Http\Request;
use DB;

class EmployeeEmergencyContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $empEmergenCon = DB::table('employee_emergency_contacts as e')
            ->select('e.id','em.id as employee','e.contact_name', 'e.relationship_to_employee','e.mobile_number','e.email')
            ->leftJoin('employees as em', 'em.id', '=', 'e.employee');
       
            $search = $request->search;
            if (!is_null($search)){
                $empEmergenCon = $empEmergenCon
                ->where('e.contact_name','LIKE','%'.$search.'%')
                ->orWhere('e.relationship_to_employee','LIKE','%'.$search.'%')
                ->orWhere('e.mobile_number','LIKE','%'.$search.'%')
                ->orWhere('e.email','LIKE','%'.$search.'%');
            }
            $empEmergenCon = $empEmergenCon->orderBy('e.id','desc')->get();
  
            return response()->json([
                "message" => "Employee Emergency Contact Data",
                "data" => $empEmergenCon,
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
    public function edit($id)
    {
        try{

            $empEmergenCon = DB::table('employee_emergency_contacts as e')
            ->select('e.id','em.id as employee','e.contact_name', 'e.relationship_to_employee','e.mobile_number','e.email')
            ->leftJoin('employees as em', 'em.id', '=', 'e.employee')
            ->where('e.id',$id)
            ->first();

            return response()->json([
                "message" => "Employee Emergency Contact Data",
                "data" => $empEmergenCon,
            ],200);
        }catch(\Throwable $e){
            return response()->json([
                "message"=>"oops something went wrong",
                "error"=> $e->getMessage(),
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'contact_name'=>'required',
                'relationship_to_employee'=>'required',
                'mobile_number'=>'required',
                'email'=>'required'
            ]);
    
            $empEmergenCon = new EmployeeEmergencyContact();
            $empEmergenCon->employee = $request->employee;
            $empEmergenCon->contact_name = $request->contact_name;
            $empEmergenCon->relationship_to_employee = $request->relationship_to_employee;
            $empEmergenCon->mobile_number = $request->mobile_number;
            $empEmergenCon->email = $request->email;
            $empEmergenCon->save();
    
            DB::commit();
    
            return response()->json([
                "message" => "Employee Emergency Contact Data",
                "data" => $empEmergenCon,
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
    public function show(EmployeeEmergencyContact $employeeEmergencyContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function create(EmployeeEmergencyContact $employeeEmergencyContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeEmergencyContact $employeeEmergencyContact, $id)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'contact_name'=>'required',
                'relationship_to_employee'=>'required',
                'mobile_number'=>'required',
                'email'=>'required'
            ]);
    
            $empEmergenCon = EmployeeEmergencyContact::find($id);
            $empEmergenCon->employee = $request->employee;
            $empEmergenCon->contact_name = $request->contact_name;
            $empEmergenCon->relationship_to_employee = $request->relationship_to_employee;
            $empEmergenCon->mobile_number = $request->mobile_number;
            $empEmergenCon->email = $request->email;
            $empEmergenCon->save();
        
            DB::commit();
        
            return response()->json([
                "message" => "Employee Emergency Contact Data",
                "data" => $empEmergenCon,
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empEmergenCon = EmployeeEmergencyContact::find($id);
        $empEmergenCon->delete();
    }
}
