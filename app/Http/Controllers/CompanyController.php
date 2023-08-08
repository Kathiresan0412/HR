<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
//use DB;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{

    public function create()
    {
        //
    }

    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        try {
            $company = Company::find($id);
            $company->delete();
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }


  public function index(Request $request)
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

  public function edit($id)
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

  public function store(Request $request)
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

  public function update(Request $request, $id)
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


