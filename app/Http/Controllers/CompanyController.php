<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use DB;


class CompanyController extends Controller
{
  public function getAll(Request $request)
  {
      try{
          $companies= DB::table('companies as c')
          ->select('c.id','c.name','c.description');

          $filterParameters = [
            'name' => 'c.name', 
        ];

        foreach ($filterParameters as $parameter => $column) {
            $value = $request->input($parameter);
            if (isset($value) && $value !== '') {
                $companies->where($column, '=', $value);
            }
        }
          $search = $request->search;

          if (!is_null($search)){
              $companies= $companies
              ->where('c.name','LIKE','%'.$search.'%')
              ->orWhere('c.description','LIKE','%'.$search.'%');
          }

          $companies = $companies->orderBy('c.id','desc')->get();

          return response()->json([
              "message" => "companies Data",
              "data" => $companies,
          ],200);
      }catch(\Throwable $e){
          return response()->json([
              "message"=>"oops something went wrong",
              "error"=> $e->getMessage(),
          ],500);
      }
  }

  public function getOne($id)
  {
      try{
          $company = DB::table('companies as c')
          ->select('c.id','c.name','c.description')
          ->where('c.id',$id)
          ->first();

          return response()->json([
              "message" => "Company Data",
              "data" => $company,
          ],200);
      }catch(\Throwable $e){
          return response()->json([
              "message"=>"oops something went wrong",
              "error"=> $e->getMessage(),
          ],500);
      }
  }

  public function save(Request $request)
  {
      DB::beginTransaction();
      try{
      $request->validate([
          'name'=>'required|string|alpha|max:30',
          'description'=>'required|string|alpha|max:255'
      ]);

      $company = new Company();
      $company->name = $request->name;
      $company->description = $request->description;
      $company->save();

      DB::commit();

      return response()->json([
          "msg" => "company Data saved",
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
                'name'=>'required|string|alpha|max:30',
                 'description'=>'required|string|alpha|max:255'
            ]);

            $company = Company::find($id);
            $company->name = $request->name;
            $company->description = $request->description;
            $company->save();  
        
            DB::commit();

            return response()->json([
            "msg" => "Company Data updated",
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
    
    public function delete($id)
    {
        try {
            $company = Company::find($id);
            $company->delete();
            return response()->json([
                "message" => "Company  data deleted successfully",
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                "message" => "Ooops Something went wrong please try again",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

}


