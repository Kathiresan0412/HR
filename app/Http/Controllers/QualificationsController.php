<?php

namespace App\Http\Controllers;

use App\Models\Qualifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QualificationsController extends Controller
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
    public function show(Qualifications $qualifications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Qualifications $qualifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Qualifications $qualifications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $qualification = Qualifications::find($id);
        $qualification->delete();
    }




  /**************************API functions**********************************/
  public function getAllQualification(Request $request,)
  {
   
      try{
          $qualification = DB::table('qualifications as q')
          ->select('q.id','q.name','q.description');
     
          $search = $request->search;
          if (!is_null($search)){
              $qualification = $qualification
              ->where('q.name','LIKE','%'.$search.'%')
              ->orWhere('q.description','LIKE','%'.$search.'%');
          }
          $qualification = $qualification->orderBy('q.id','desc')->get();

          return response()->json([
              "message" => "qualification Data",
              "data" => $qualification,
          ],200);
      }catch(\Throwable $e){
          return response()->json([
              "message"=>"oops something went wrong",
              "error"=> $e->getMessage(),
          ],500);
      }
  }

  public function getQualificationInfo($id)
  {
      try{

          $qualification = DB::table('qualifications as q')
          ->select('q.id','q.name','q.description')
          ->where('q.id',$id)
          ->first();

          return response()->json([
              "message" => "Qualification Data",
              "data" => $qualification,
          ],200);
      }catch(\Throwable $e){
          return response()->json([
              "message"=>"oops something went wrong",
              "error"=> $e->getMessage(),
          ],500);
      }
  }

  public function saveQualification(Request $request)
  {
      DB::beginTransaction();
      try{
      $request->validate([
          'name'=>'required',
          'description'=>'required'
      ]);

      $qualification = new Qualifications();
      $qualification->name = $request->name;
      $qualification->description = $request->description;
      $qualification->save();

      DB::commit();

      return response()->json([
          "msg" => "Qualification Data",
          "data"=> $qualification,
      ],201);
  }catch(\Throwable $e) {
      DB::rollback();
      return response()->json([
          "msg"=>"oops something went wrong",
          "error"=> $e->getMessage(),
      ],500);
  }
  }

  public function updateQualification(Request $request, $id)
  {
      DB::beginTransaction();
      try{
      $request->validate([
         'name'=>'required',
         'description'=>'required'
      ]);

      $qualification = Qualifications::find($id);
      $qualification->name = $request->name;
      $qualification->description = $request->description;
      $qualification->save();  
   
    DB::commit();

    return response()->json([
      "msg" => "Qualification Data",
      "data"=> $qualification,
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

