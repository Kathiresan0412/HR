<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
//use DB;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
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
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
    }




      /**************************API functions**********************************/
  public function getAllCompany(Request $request,)
  {
   
      try{
          $company = DB::table('companies as c')
          ->select('c.id','c.name','c.description');
     
          $search = $request->search;
          if (!is_null($search)){
              $company = $company
              ->where('c.name','LIKE','%'.$search.'%')
              ->orWhere('c.description','LIKE','%'.$search.'%');
          }
          $company = $company->orderBy('c.id','desc')->get();

          return response()->json([
              "message" => "company Data",
              "data" => $company,
          ],200);
      }catch(\Throwable $e){
          return response()->json([
              "message"=>"oops something went wrong",
              "error"=> $e->getMessage(),
          ],500);
      }
  }

  public function getCompanyInfo($id)
  {
      try{

          $company = DB::table('companies as c')
          ->select('c.id','c.name','c.description')
          ->where('c.id',$id)
          ->first();

          return response()->json([
              "message" => "company Data",
              "data" => $company,
          ],200);
      }catch(\Throwable $e){
          return response()->json([
              "message"=>"oops something went wrong",
              "error"=> $e->getMessage(),
          ],500);
      }
  }

  public function saveCompany(Request $request)
  {
      DB::beginTransaction();
      try{
      $request->validate([
          'name'=>'required',
          'description'=>'required'
      ]);

      $company = new Company();
      $company->name = $request->name;
      $company->description = $request->description;
      $company->save();

      DB::commit();

      return response()->json([
          "msg" => "company Data",
          "data"=> $company,
      ],201);
  }catch(\Throwable $e) {
      DB::rollback();
      return response()->json([
          "msg"=>"oops something went wrong",
          "error"=> $e->getMessage(),
      ],500);
  }
  }

  public function updateCompany(Request $request, $id)
  {
      DB::beginTransaction();
      try{
      $request->validate([
         'name'=>'required',
         'description'=>'required'
      ]);

      $company = Company::find($id);
      $company->name = $request->name;
      $company->description = $request->description;
      $company->save();  
   
    DB::commit();

    return response()->json([
      "msg" => "company Data",
      "data"=> $company,
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


